<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Models\Project;
use App\Models\Projectfile;
use App\Models\ProjectStatusChangeLog;
use App\Models\User;
use App\Models\UserPersonalDataShare;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index(Request $request){
        $projects = Project::with('projectaddress')->where('user_id','=',$request->user()->id)->get();
        return response()->json($projects, 200);
    }
    public function show(Request $request, Project $project){
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

    public function add_project(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=> 'required|integer',
            'forename' => 'required|string',
            'surname' => 'required|string',
            'project_name' => 'required|string',
            'description' => 'required|string',
            'contact_mobile_no' => 'required|string',
            'contact_home_phone' => 'required|string',
            'contact_email' => 'required|string',
            'postcode' => 'required|string',
            'county' => 'required|string',
            'town' => 'required|string',
            'categories' => 'required|string',
            'subcategories' => 'required|string',
            'status' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'required|max:'.(config('const.dropzone_max_file_size')*1024).'|mimetypes:'.config('const.dropzone_accepted_image'),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $result = Project::create([
                'user_id'=> $request->user()->id,
                'builder_category_id' => null,
                'builder_subcategory_id' => null,
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
                'categories' => $request->categories,
                'subcategories' => $request->subcategories,
                'customer_note' => null,
                'tradeperson_note' => null,
                'internal_note' => null,
                'status' => $request->status,
                'reviewer_id' => null,
                'reviewer_status' => null,
                'reviewer_status_updated_at' => null,
                'notes'=> $request->notes
            ]);
            if (!$result) {
                throw ValidationException::withMessages(['message' => 'Something went wrong, please try again!'], 500);
            }
            foreach ($request->images as $file) {
                $testFolderName = config('const.s3FolderName');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put($testFolderName.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url($testFolderName.$s3FileName);

                $projectfile_entry = Projectfile::create([
                    'project_id'=> $result->id,
                    'file_type' => $file_type,
                    'filename' => $fileName,
                    'file_original_name' => $fileName,
                    'file_extension' => $extension,
                    'url' => $path
                ]);
            }

            return response()->json(['message'=>'Project saved successfully'],200);
        } catch(Exception $e){
            DB::rollback();
            return response()->json($e->getMessage(),500);
        }
    }

    public function update_project(Request $request){
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|max:'.(config('const.dropzone_max_file_size')*1024).'|mimetypes:'.config('const.dropzone_accepted_image'),
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $project =Project::where('id',$request->project_id)->first();
            if (!$project) {
                return response()->json(['message' => 'Project not found'], 404);
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
            return response()->json(['message'=>"Project updated successfully"], 200);
        } catch(Exception $e){
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function cancel_project(Request $request){
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'status' => 'required'
        ]);

        try{
            Project::where('id', $request->project_id)->update(['status' => 'project_cancelled']);

            // cancel_project_notification($request->project_id); //ToDo

            return response()->json(['message'=>"The project has been canceled successfully."], 200);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }


    public function paused_project(Request $request){
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'status' => 'required'
        ]);

        try {
            Project::where('id', $request->project_id)->update(['status' => 'project_paused']);

            // project_paused_notification($request->project_id); //ToDo

            return response()->json(['message'=>"The project has been paused successfully."], 200);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function resumeProject(Request $request) {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        try {
            $user = $request->user()->id;
            Project::where('id', $request->id)->update(['status' => 'project_started']);
            ProjectStatusChangeLog::create([
                'project_id'        => $request->id,
                'action_by_id'      => $user,
                'action_by_type'    => 'user',
                'status'            => 'project_started',
                'status_changed_at' => now(),
            ]);
            return response()->json(['message'=>"The project has been resumed successfully."], 200);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function view_all_estimates(Request $request){
        try{
            $estimates = Estimate::where('project_id', $request->id)->get();
            if(!$estimates) {
                return response()->json(['message'=>"You have no estimate."]);
            }
            return response()->json($estimates,200);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function accept_estimate(Request $request){
        $validator = Validator::make($request->all(), [
            'tradesperson_id' => 'required|integer',
            'status' => 'required|string',
            'settings' => 'required|json',
            'project_awarded' => 'required|integer|max:1',
            'project_id' => 'required|integer',
            'action_by_id' => 'required|integer',
            'action_by_type' => 'required|string',
            'status_changed_at' => 'required|date|date_format:Y-m-d H:i:s',
            'read_status' => 'required|integer|max:1',
            'notification_text' => 'required|string',
            'related_to_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $estimate = Estimate::where('id', $request->estimate_id)->first();
            $tradeperson = User::where('id', $estimate->tradesperson_id)->first();
            $project = Project::where('id', $estimate->project_id)->first();
            $user_personal_data = UserPersonalDataShare::where('project_id', $estimate->project_id)->first();

            // Update project table
            Project::where('id', $estimate->project_id)
                    ->update([
                        'status' => 'project_started'
                    ]);
            // Update estimate table
            Estimate::where('id', $estimate->id)
                    ->update([
                        'project_awarded' => 1,
                        'status' => 'awarded'
                    ]);
            //Insert data into project_status_change_log table
            $projStatusChangeLog = new ProjectStatusChangeLog();
            $projStatusChangeLog->project_id = $project->id;
            $projStatusChangeLog->action_by_id = $request->user()->id;
            $projStatusChangeLog->action_by_type = 'user';
            $projStatusChangeLog->status = 'project_started';
            $projStatusChangeLog->status_changed_at = Carbon::now();
            $projStatusChangeLog->save();
            //Insert data into user_personal_data_shares table
            if ($user_personal_data) {
                UserPersonalDataShare::where('project_id', $project->id)
                                        ->update([
                                            'settings' => $request->settings
                                        ]);
            } else {
                $userPersonalData = new UserPersonalDataShare();
                $userPersonalData->user_id = $request->user()->id;
                $userPersonalData->project_id = $project->id;
                $userPersonalData->tradeperson_id = $tradeperson->id;
                $userPersonalData->settings = $request->settings;
                $userPersonalData->save();
            }

            // Check Notification settings
            $notify_settings = Notification::where('user_id', $tradeperson->id)->first();
            if($notify_settings) {
                if($notify_settings->settings != null){
                    $noti_accepted = $notify_settings->settings['noti_quote_accepted'];
                } else {
                    $noti_accepted = 1;
                }
            }
            // Notification
            if($noti_accepted == 1){
                $html = view('email.estimate-accepted-email')
                        ->with('data', [
                        'project_name'       => $project->project_name,
                        'user_name'          => $tradeperson->name
                        ])
                        ->render();
                $emaildata = array(
                    'From'          =>  env('MAIL_FROM_ADDRESS'),
                    'To'            =>  $tradeperson->email,
                    'Subject'       => 'Your given estimate has been accepted',
                    'HtmlBody'      =>  $html,
                    'MessageStream' => 'outbound'
                );
                $email_sent = send_email($emaildata);

                // Insert data into Notification_details table
                $notificationDetail = new NotificationDetail();
                $notificationDetail->user_id = $tradeperson->id;
                $notificationDetail->from_user_id = $request->user()->id;
                $notificationDetail->from_user_type = 'customer';
                $notificationDetail->related_to = 'project';
                $notificationDetail->related_to_id = $project->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'Your given estimate has been accepted';
                $notificationDetail->reviewer_note = null;
                $notificationDetail->save();
            }

            return response()->json(['message'=>"You have accepted the estimate."]);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function reject_estimate(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'related_to_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $estimate = Estimate::where('id', $request->estimate_id)->first();
            $tradeperson = User::where('id', $estimate->tradesperson_id)->first();
            $project = Project::where('id', $estimate->project_id)->first();

            Estimate::where('id', $estimate->id)
                    ->update([
                        'status' => 'rejected'
                    ]);

            // Check Notification settings
            $notify_settings = Notification::where('user_id', $tradeperson->id)->first();
            if($notify_settings) {
                if($notify_settings->settings != null){
                    $noti_rejected = $notify_settings->settings['noti_quote_rejected'];
                } else {
                    $noti_rejected = 1;
                }
            }
            // mail
            if($noti_rejected == 1){
                $html = view('email.estimate-rejected-email')
                                ->with('data', [
                                'project_name'       => $project->project_name,
                                'user_name'          => $tradeperson->name
                                ])
                                ->render();
                $emaildata = array(
                    'From'          =>  env('MAIL_FROM_ADDRESS'),
                    'To'            =>  $tradeperson->email,
                    'Subject'       => 'Your given estimate has been rejected',
                    'HtmlBody'      =>  $html,
                    'MessageStream' => 'outbound'
                );
                $email_sent = send_email($emaildata);

                // new entry in notification_details table
                $notificationDetail = new NotificationDetail();
                $notificationDetail->user_id = $tradeperson->id;
                $notificationDetail->from_user_id = $request->user()->id;
                $notificationDetail->from_user_type = $request->user()->customer_or_tradesperson;
                $notificationDetail->related_to = 'project';
                $notificationDetail->related_to_id = $project->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'Your given estimate for '.$project->project_name.' has been rejected';
                $notificationDetail->reviewer_note = null;
                $notificationDetail->save();
            }

            return response()->json(['message'=>"You have successfully rejected the estimate."]);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
