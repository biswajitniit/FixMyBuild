<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buildercategory;
use App\Models\Project;
use App\Models\Buildersubcategory;
use App\Models\Estimate;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hashids\Hashids;
use Carbon\Carbon;

if (! function_exists('Hashids_encode')) {
    function Hashids_encode($id) {
       $hashids = new Hashids('erwerwerwer12353335',50,'0123456789abcdefghijklmnopqrstuvwxyz');
       //$hashids = new Hashids();
       return $hashids->encode($id);
    }
}

if (! function_exists('Hashids_decode')) {
    function Hashids_decode($id) {
        $hashids = new Hashids('erwerwerwer12353335',50,'0123456789abcdefghijklmnopqrstuvwxyz');
       return $hashids->decode($id);
    }
}

if (! function_exists('GetBuildercategoryname')) {
    function GetBuildercategoryname($bcid) {
      //DB::enableQueryLog();
	  return Buildercategory::where('id', $bcid)->first()->builder_category_name;
       //$query = DB::getQueryLog();
       //dd($query);
    }
}

if (! function_exists('GetBuildersubcategory')) {
    function GetBuildersubcategory($bcid) {
      //DB::enableQueryLog();
	  return Buildersubcategory::where('builder_category_id', $bcid)->get();
       //$query = DB::getQueryLog();
       //dd($query);
    }
}
if (! function_exists('getRemoteFileSize')) {
    function getRemoteFileSize($url) {
        $parse = parse_url($url);
        $host = $parse['host'];
        $fp = @fsockopen ($host, 80, $errno, $errstr, 20);
        if(!$fp){
          $ret = 0;
        }else{
          $host = $parse['host'];
          fputs($fp, "HEAD ".$url." HTTP/1.1\r\n");
          fputs($fp, "HOST: ".$host."\r\n");
          fputs($fp, "Connection: close\r\n\r\n");
          $headers = "";
          while (!feof($fp)){
            $headers .= fgets ($fp, 128);
          }
          fclose ($fp);
          $headers = strtolower($headers);
          $array = preg_split("|[\s,]+|",$headers);
          $key = array_search('content-length:',$array);
          $ret = $array[$key+1];
        }
        if($array[1]==200){
            if($ret< 1024){
                return $ret.' B';
            }
            if($ret< 1048576){
                return round($ret / 1024, 2) .' KB';
            }
            if($ret < 1073741824){
                return round($ret / 1048576, 2) . ' MB';
            }
            if($ret < 1099511627776){
                return round($ret / 1073741824, 2) . ' GB';
            }
        } else {
            return -1*$array[1];
        }
    }
}
function send_email($postdata){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => env('POSTMARKURL'),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($postdata),
      CURLOPT_HTTPHEADER => array(
        'X-Postmark-Server-Token: '.env('POSTMARKTOKEN'),
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
if (!function_exists('tradesperson_project_status')) {
    function tradesperson_project_status($project_id)
    {
        $project = Project::where('id', $project_id)->first();
        if ($project->status === 'cancelled') {
            return 'project_cancelled';
        }
        if ($project->status === 'paused') {
            return 'project_paused';
        }
        if ($project->status === 'completed' || $project->status === 'awaiting_your_review') {
            return 'project_completed';
        }

        if($project->status === 'estimation') {
            $estimate_recalled = Estimate::where('project_id', $project_id)
                                ->where('tradesperson_id', Auth::user()->id)
                                ->first();

            if (empty($estimate_recalled)) {
                return 'write_estimate';
            }
            if ($estimate_recalled->project_awarded == 0 && $estimate_recalled->status == 'recalled') {
                return 'estimate_recalled';
            }
            if ($estimate_recalled->project_awarded == 0 && $estimate_recalled->status == null) {
                return 'estimate_submitted';
            }
            if ($estimate_recalled->project_awarded == 0 && $estimate_recalled->status == 'rejected') {
                return 'estimate_rejected';
            }
        }

        if($project->status === 'project_started') {
            $project_started = Estimate::where('project_id', $project_id)
                                ->where('tradesperson_id', Auth::user()->id)
                                ->first();


            if ($project_started->project_awarded == 0) {
                return 'estimate_not_accepted';
            }
            if ($project_started->project_awarded == 1 && $project_started->status == 'awarded') {
                return 'estimate_accepted';
            }

        }

    }
}
function time_diff($created_at){
    $now = Carbon::now();
    $created = Carbon::parse($created_at);
    if ($now->diffInMinutes($created) < 60) {
        return $now->diffInMinutes($created) . ' minutes ago';
    } elseif ($now->diffInHours($created) < 24) {
        return $now->diffInHours($created) . ' hours ago';
    } elseif ($now->diffInDays($created) == 1) {
        return 'yesterday';
    } else {
        return date('F j, Y', strtotime($created));
    }
}
function milestone_completion_notification($task_id){
    $task = Task::where('id', $task_id)->first();
    $estimate = Estimate::where('id', $task->estimate_id)->first();
    $project = Project::where('id', $estimate->project_id)->first();
    $user = User::where('id', $project->user_id)->first();
    $notify_settings = Notification::where('user_id', $project->user_id)->first();
    if($notify_settings) {
        if($notify_settings->settings != null){
            $project_milestone = $notify_settings->settings['project_milestone_complete'];
        }
    }
    if($project_milestone == 1){
        $html = view('email.milestone-complete')
            ->with('data', [
            'project_name'       => $project->project_name,
            'user_name'          => $user->name
            ])
            ->render();
        $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            => $user->email,
            'Subject'       => 'Milestone Completed',
            'HtmlBody'      => $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);
        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $user->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->type;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Your project milestone has been completed';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}

function project_paused_notification($project_id){
    $project = Project::where('id', $project_id)->first();
    $estimate = Estimate::where('project_id', $project_id)->first();
    $customer = Auth::user();
    $tradeperson = User::where('id', $estimate->tradesperson_id)->first();
    $notify_settings_customer = Notification::where('user_id', Auth::user()->id)->first();
    $notify_settings_trader = Notification::where('user_id', $estimate->tradesperson_id)->first();
    $project_paused = 0;
    // For customer
    if($notify_settings_customer)
        $project_paused = $notify_settings_customer->settings['paused'];

    if($project_paused == 1){
        $html = view('email.project-paused-customer')
            ->with('data', [
            'project_name'       => $project->project_name,
            'user_name'          => $customer->name
            ])
            ->render();
        $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            =>  $customer->email,
            'Subject'       => 'Project Paused',
            'HtmlBody'      =>  $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);

        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $customer->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Your project has been paused';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }

    // For tradeperson
    if($notify_settings_trader) {
        if($notify_settings_trader->settings != null){
            $project_paused_trader = $notify_settings_trader->settings['noti_project_stopped'];
        }
    }

    if($project_paused_trader == 1){
        $html = view('email.project-paused-trader')
            ->with('data', [
            'project_name'       => $project->project_name,
            'user_name'          => $tradeperson->name
            ])
            ->render();
        $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            =>  $tradeperson->email,
            'Subject'       => 'Paused Project',
            'HtmlBody'      =>  $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);

        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $tradeperson->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Customer has paused the project';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}
function estimate_rejected_notification($tradeperson, $project){
    // Check Notification settings
    $notify_settings = Notification::where('user_id', $tradeperson->id)->first();
    if($notify_settings) {
        if($notify_settings->settings != null){
            $noti_rejected = $notify_settings->settings['noti_quote_rejected'];
        } else {
            $noti_rejected = 1;
        }
    }
    // Notification
    if($noti_rejected == 1){
        $html = view('email.estimate-rejected-email')
                        ->with('data', [
                        'project_name'       => $project->project_name,
                        'user_name'          => $tradeperson->name
                        ])
                        ->render();
        $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            =>  $tradeperson->email,
            'Subject'       => 'Your Given Estimate Has Been Rejected',
            'HtmlBody'      =>  $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);

        // Notificatin Insert in DB
        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $tradeperson->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Your Given Estimate Has Been Rejected';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}
function cancel_project_notification($projectId){
    $project = Project::where('id', $projectId)->first();
    $estimate = Estimate::where('project_id', $projectId)->first();
    $user = User::where('id', $estimate->tradesperson_id)->first();
    // Check Notification settings
    $notify_settings = Notification::where('user_id', $user->id)->first();
    if($notify_settings) {
        if($notify_settings->settings != null){
            $noti_cancelled = $notify_settings->settings['noti_quote_rejected'];
        } else {
            $noti_cancelled = 1;
        }
    }
    // Notification
    if($noti_cancelled == 1){
        $html = view('email.project-cancelled')
                        ->with('data', [
                        'project_name'       => $project->project_name,
                        'user_name'          => $user->name
                        ])
                        ->render();
        $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            =>  $user->email,
            'Subject'       => 'Your project has been Cancelled',
            'HtmlBody'      =>  $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);

        // Notificatin Insert in DB
        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $user->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Your project has been Cancelled';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}
function project_completed_notification($estimateId){
    $estimate = Estimate::where('id', $estimateId)->first();
    $project = Project::where('id', $estimate->project_id)->first();
    $user = User::where('id', $project->user_id)->first();

    // Check Notification settings
    $notify_settings = Notification::where('user_id', $user->id)->first();
    if($notify_settings) {
        if($notify_settings->settings != null){
            $noti_complete = $notify_settings->settings['project_complete'];
        } else {
            $noti_complete = 1;
        }
    }
    // Notification
    if($noti_complete == 1){
        $html = view('email.project-completed')
                        ->with('data', [
                        'project_name'       => $project->project_name,
                        ])
                        ->render();
        $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            =>  $user->email,
            'Subject'       => 'Your project has been Ccompleted',
            'HtmlBody'      =>  $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);

        // Notificatin Insert in DB
        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $user->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Your project has been Ccompleted';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}
