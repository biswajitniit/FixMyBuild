<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\Project;
use App\Models\Projectaddresses;
use App\Models\Projectfile;
use App\Models\ProjectStatusChangeLog;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Rules\PhoneWithDialCode;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\CustomerProjectCollection;
use App\Models\ProjectReview;

class ProjectController extends BaseController
{
    private function can_resume_project($project, $estimate)
    {
        $user = request()->user();

        return (($project->user_id == $user->id && $project->status == config('const.project_status.PROJECT_PAUSED')) ||
                ($estimate->tradesperson_id == $user->id && $project->status == config('const.project_status.TRADER_PROJECT_PAUSED')));
    }


    public function index(Request $request) {
        $validator = Validator::make(request()->all(), [
            'history' => 'nullable|boolean',
            'new' => 'nullable|boolean',
            'order_by' => 'nullable|string|max:191',
            'order_by_type' => 'nullable|string|in:desc,asc',
            'limit' => 'nullable|numeric',
            'page' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return $this->error(['errors' => $validator->errors()], 422);
        }

        try {
            $projects = Project::with('projectaddress')
                ->where('user_id', $request->user()->id)
                ->when(($request->filled('history') && $request->history == 1) && !($request->filled('new') && $request->new == 1), function ($query) {
                    return $query->whereIn('status', config('const.project_history_statuses'));
                })
                ->when(($request->filled('new') && $request->new == 1) && !($request->filled('history') && $request->history == 1), function ($query) {
                    return $query->whereNotIn('status', config('const.project_history_statuses'));
                })
                ->when($request->filled('order_by'), function ($query) use ($request) {
                    $query->orderBy('projects.'.$request->order_by, $request->order_by_type ?? 'desc');
                }, function ($query) {
                    $query->orderBy('projects.created_at', 'desc');
                })
                ->paginate($request->limit ?? Project::count());

            return $this->success((new CustomerProjectCollection($projects))->additional($projects));
        } catch (Exception $e) {
            return $this->error(['errors' => $e->getMessage()], 500);
        }
    }


    public function show(Request $request, $project) {
        try{
            $project = Project::with('projectaddress')
                   ->with('projectfiles')
                   ->with('projectnotesandcommends')
                   ->where('id',$project)
                   ->first();
            $estimate = Estimate::where(['project_id' => $project->id, 'project_awarded' => 1])->with('tradesperson')->first();
            $data = ['project' => $project, 'estimate' => $estimate];

            return response()->json($data, 200);
        } catch(ModelNotFoundException $e){
            return response()->json("Project not found!", 500);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }


    public function add_project(Request $request) {
        $validator = Validator::make($request->all(), [
            'forename' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_mobile_no' => ['required', new PhoneWithDialCode()],
            'contact_home_phone' => ['required', new PhoneWithDialCode()],
            'contact_email' => ['required', 'email:rfc,dns'],

            'address_type' => ['required', Rule::in(config('const.address_types'))],
            'postcode' => ['required', 'string', 'max:10'],
            'county' => ['required', 'string', 'max:20'],
            'town' => ['required', 'string', 'max:20'],
            'address_line_one' => [
                Rule::requiredIf($request->address_types == config('const.address_types.TYPE_ADDRESS')),
                'string', 'max:255'
            ],
            'address_line_two' => ['nullable', 'string', 'max:255'],

            'images' => 'required|array',
            'images.*' => 'required|file|max:'.(config('const.dropzone_max_file_size')*1024).'|mimetypes:'.Str::replace(' ', '', config('const.dropzone_accepted_image')),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            DB::beginTransaction();

            $result = Project::create([
                'user_id'=> $request->user()->id,
                'forename' => $request->forename,
                'surname' => $request->surname,
                'project_name' => $request->project_name,
                'description' => $request->description,
                'contact_mobile_no' => $request->contact_mobile_no,
                'contact_home_phone' => $request->contact_home_phone,
                'contact_email' => $request->contact_email,
                'postcode' => $request->postcode,
                'county' => $request->county,
                'town' => $request->town,
            ]);

            Projectaddresses::create([
                'project_id' => $result->id,
                'address_line_one' => $request->address_line_one,
                'address_line_two' => $request->address_line_two,
                'town_city' => $request->town,
                'postcode' => $request->postcode,
            ]);

            foreach ($request->file('images') as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put(config('const.s3FolderName').$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url(config('const.s3FolderName').$s3FileName);

                $projectfile_entry = Projectfile::create([
                    'project_id'=> $result->id,
                    'file_type' => $file_type,
                    'filename' => $fileName,
                    'file_original_name' => $fileName,
                    'file_extension' => $extension,
                    'url' => $path
                ]);
            }

            DB::commit();

            return $this->success('Project added successfully!',200);
        } catch(Exception $e){
            DB::rollback();

            return $this->error(['error' => $e->getMessage()],500);
        }
    }


    public function update_project(Request $request, $project_id) {
        $validator = Validator::make($request->all(), [
            'forename' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_mobile_no' => ['required', new PhoneWithDialCode()],
            'contact_home_phone' => ['required', new PhoneWithDialCode()],
            'contact_email' => ['required', 'email:rfc,dns'],
            'address_type' => ['required', Rule::in(config('const.address_types'))],
            'postcode' => ['required', 'string', 'max:10'],
            'county' => ['required', 'string', 'max:20'],
            'town' => ['required', 'string', 'max:20'],
            'address_line_one' => [
                Rule::requiredIf($request->address_types == config('const.address_types.TYPE_ADDRESS')),
                'string', 'max:255'
            ],
            'address_line_two' => ['nullable', 'string', 'max:255'],
            'images' => 'required|array',
            'images.*' => 'required|file|max:'.(config('const.dropzone_max_file_size')*1024).'|mimetypes:'.Str::replace(' ', '', config('const.dropzone_accepted_image')),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            DB::beginTransaction();

            $project = Project::where('id', $project_id)->first();

            if (!$project) {
                return $this->error('Project not found!', 404);
            }

            if($project->user_id != request()->user()->id) {
                return $this->error('You are not authorized to update this project!', 403);
            }

            $project->forename = $request->forename;
            $project->surname = $request->surname;
            $project->project_name = $request->project_name;
            $project->description = $request->description;
            $project->contact_mobile_no = $request->contact_mobile_no;
            $project->contact_home_phone = $request->contact_home_phone;
            $project->contact_email = $request->contact_email;
            $project->postcode = $request->postcode;
            $project->county = $request->county;
            $project->town = $request->town;
            if(!$project->save()){
                return response()->json(['error'=>'Unexpected error, please try after sometimes'],500);
            }

            Projectaddresses::where('project_id', $project->id)->update([
                'address_line_one' => $request->address_line_one,
                'address_line_two' => $request->address_line_two,
                'town_city' => $request->town,
                'postcode' => $request->postcode,
            ]);

            $old_project_files = Projectfile::where('project_id', $project->id)->select('id','url')->get()->toArray();

            //update images
            foreach ($request->file('images') as $file) {
                $testFolderName = config('const.s3FolderName');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put($testFolderName.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url($testFolderName.$s3FileName);

                Projectfile::create([
                    'project_id' => $project->id,
                    'file_type' => $file_type,
                    'filename' => $fileName,
                    'file_original_name' => $fileName,
                    'file_extension' => $extension,
                    'url' => $path
                ]);
            }

            $old_media_paths = array_map(function($file) {
                return parse_url($file['url'], PHP_URL_PATH);
            }, $old_project_files);

            $successfully_deleted = Storage::disk('s3')->delete($old_media_paths);
            if(!$successfully_deleted){
                throw new Exception('Something went wrong, please try again later.');
            }

            $old_media_ids = array_map(function($file) {
                return parse_url($file['id'], PHP_URL_PATH);
            }, $old_project_files);

            ProjectFile::whereIn('id', $old_media_ids)->delete();

            DB::commit();

            return response()->json(['message'=>"Project updated successfully"], 200);
        } catch(Exception $e){
            DB::rollback();

            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function cancel_project(Request $request, int $project_id) {
        try{
            $project = Project::findOrFail($project_id);

            if($project->user_id != request()->user()->id) {
                return $this->error('You are not authorized to cancel this project!', 403);
            }

            DB::beginTransaction();

            $project->status = config('const.project_status.PROJECT_CANCELLED');
            $project->save();

            // TODO: Send email notification to traders and customers
            // cancel_project_notification($project_id);
            ProjectStatusChangeLog::create([
                'project_id'        => $project_id,
                'action_by_id'      => request()->user()->id,
                'action_by_type'    => 'user',
                'status'            => config('const.project_status.PROJECT_CANCELLED'),
                'status_changed_at' => now(),
            ]);

            DB::commit();

            return $this->success("The project has been cancelled successfully.", 200);
        } catch(ModelNotFoundException $e){
            DB::rollBack();

            return $this->error('Project Not Found.', 404);
        } catch(Exception $e){
            DB::rollBack();

            return response()->json($e->getMessage(), 500);
        }
    }


    public function pause_project(Request $request, $project_id) {
        try {
            $project = Project::findOrFail($project_id);
            $estimate = Estimate::where(['project_id' => $project->id, 'project_awarded' => 1])->first();

            if (!$estimate || $project->status != config('const.project_status.PROJECT_STARTED')) {
                return $this->error('You can only pause a project which has been started! ', 400);
            }

            DB::beginTransaction();

            if ($project->user_id == request()->user()->id) {
                $project->status = config('const.project_status.PROJECT_PAUSED');
            } else if ($estimate->tradesperson_id == request()->user()->id) {
                $project->status = config('const.project_status.TRADER_PROJECT_PAUSED');
            } else {
                return $this->error('You are not authorized to pause this project!', 403);
            }

            $project->save();
            ProjectStatusChangeLog::create([
                'project_id'        => $project_id,
                'action_by_id'      => request()->user()->id,
                'action_by_type'    => 'user',
                'status'            => config('const.project_status.PROJECT_PAUSED'),
                'status_changed_at' => now(),
            ]);

            // TODO: Implement different mail templates for trader and customer when trader pause the project
            // pause_project_notification($request->project_id);
            DB::commit();

            return $this->success("The project has been paused successfully.", 200);
        } catch(ModelNotFoundException $e){
            DB::rollBack();

            return $this->error('Project Not Found.', 404);
        } catch(Exception $e){
            DB::rollBack();

            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function resume_project(Request $request, $project_id) {

        try {
            DB::beginTransaction();

            $project = Project::findOrFail($project_id);
            $estimate = $project->estimates()->where('project_awarded', 1)->first();

            if (!($project->status == config('const.project_status.PROJECT_PAUSED') || $project->status == config('const.project_status.TRADER_PROJECT_PAUSED'))) {
                return $this->error('Only paused project can be resumed!', 400);
            }

            if (! $this->can_resume_project($project, $estimate)) {
                return $this->error('You are not authorized to resume this project!', 403);
            }

            $project->status = config('const.project_status.PROJECT_STARTED');
            $project->save();

            ProjectStatusChangeLog::create([
                'project_id'        => $project_id,
                'action_by_id'      => request()->user()->id,
                'action_by_type'    => 'user',
                'status'            => config('const.project_status.PROJECT_STARTED'),
                'status_changed_at' => now(),
            ]);

            DB::commit();

            return $this->success("The project has been resumed successfully.", 200);
        } catch(Exception $e){
            DB::rollBack();

            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function submit_review(Request $request, int $project_id)
    {
        $validator = Validator::make($request->all(), [
            'punctuality' => ['required', 'boolean'],
            'workmanship' => ['required', 'boolean'],
            'tidiness' => ['required', 'boolean'],
            'price_accuracy' => ['required', 'boolean'],
            'detailed_review' => ['required', 'boolean'],
            'detailed_review_description' => ['nullable', 'required_if:detailed_review,true', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->error(['errors' => $validator->errors()], 422);
        }

        try {
            $project = Project::find($project_id);
            $tradeperson_id = Estimate::where(['project_id' => $project_id, 'project_awarded' => 1, 'status' => 'awarded'])->value('tradesperson_id');
            $project_review = ProjectReview::where(['project_id' => $project_id])->first();

            if (!$project) {
                return $this->error('Project not found', 404);
            }

            if ($project->user_id != $request->user()->id) {
                return $this->error('You are not authorized to review this project!', 403);
            }

            if (!$tradeperson_id) {
                return $this->error('No tradesperson found for this project', 404);
            }

            if ($project_review) {
                return $this->error('You have already submitted a review for this project', 400);
            }

            DB::beginTransaction();

            $review = new ProjectReview();
            $review->user_id = $request->user()->id;
            $review->project_id = $project_id;
            $review->tradesperson_id = $tradeperson_id;
            $review->punctuality = $request->punctuality;
            $review->workmanship = $request->workmanship;
            $review->tidiness = $request->tidiness;
            $review->price_accuracy = $request->price_accuracy;
            $review->detailed_review = $request->detailed_review;
            $review->description = $request->detailed_review ? $request->detailed_review_description : null;
            $review->save();

            $project->status = config('const.project_status.PROJECT_COMPLETED');
            $project->save();

            project_completed_notification($project_id);

            DB::commit();

            return $this->success("Review submitted successfully.", 200);
        } catch(Exception $e) {
            DB::rollBack();

            return $this->error(['errors' => $e->getMessage()], 500);
        }
    }


    public function milestone_wizard(Request $request, int $project)
    {
        return ProjectStatusChangeLog::where('project_id', $project)->get();
    }
}
