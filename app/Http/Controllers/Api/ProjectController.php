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

class ProjectController extends BaseController
{
    public function index(Request $request) {
        $projects = Project::with('projectaddress')->where('user_id','=',$request->user()->id)->get();
        return response()->json($projects, 200);
    }


    public function show(Request $request, Project $project) {
        try{
            $data = Project::with('projectaddress')
                   ->with('projectfiles')
                   ->with('projectnotesandcommends')
                   ->where('id','=',$project->id)->get();
            return response()->json($data, 200);
        } catch(Exception $e){
            return response()->json($e, 500);
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


    public function update_project(Request $request) {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|max:'.(config('const.dropzone_max_file_size')*1024).'|mimetypes:'.config('const.dropzone_accepted_image'),
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            DB::beginTransaction();

            $project = Project::where('id',$request->project_id)->first();
            if (!$project) {
                return $this->error('Project not found!', 404);
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
            $project->categories = $request->categories;
            $project->subcategories = $request->subcategories;
            $project->notes = $request->notes;
            if(!$project->save()){
                return response()->json(['message'=>'Unexpected error, please try after sometimes'],500);
            }
            //delete images
            $previousFiles = Projectfile::where('project_id', $project->id)->get();

            foreach ($previousFiles as $previousFile) {
                $parsedUrl = parse_url($previousFile);
                if ($parsedUrl !== false) {
                    $s3Path = $parsedUrl['path'];
                    Storage::disk('s3')->delete($s3Path);
                    $previousFile->delete();
                } else {
                    echo "Invalid URL";
                }
            }
            //update images
            foreach ($request->images as $file) {
                $testFolderName = config('const.s3FolderName');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put($testFolderName.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url($testFolderName.$s3FileName);

                $projectfile_entry = Projectfile::updateOrCreate(
                    ['project_id' => $project->id],
                    [
                        'file_type' => $file_type,
                        'filename' => $fileName,
                        'file_original_name' => $fileName,
                        'file_extension' => $extension,
                        'url' => $path
                    ]
                );
            }

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
            $project->status = config('const.project_status.PROJECT_CANCELLED');
            $project->save();

            // ToDo: Send email notification to traders and customers
            // cancel_project_notification($project_id);

            return $this->success("The project has been canceled successfully.", 200);
        } catch(ModelNotFoundException $e){
            return $this->error('Project Not Found.', 404);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }


    public function pause_project(Request $request, $project_id) {
        try {
            $project = Project::findOrFail($project_id);
            $project->status = config('const.project_status.PROJECT_PAUSED');
            $project->save();

            // ToDo: Send email notification to traders and customers
            // project_paused_notification($request->project_id);

            return $this->success("The project has been paused successfully.", 200);
        } catch(ModelNotFoundException $e){
            return $this->error('Project Not Found.', 404);
        } catch(Exception $e){
            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function resume_project(Request $request, $project_id) {

        try {
            DB::beginTransaction();

            // TODO: If customer pause the project then only they can resume the project and if trader pause the project then only they can resume the project.
            $project = Project::findOrFail($project_id);
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
}
