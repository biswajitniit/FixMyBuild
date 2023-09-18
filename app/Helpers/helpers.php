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
use App\Models\TraderDetail;
use Illuminate\Support\Facades\Auth;
use Hashids\Hashids;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


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
        if ($project->status === 'project_cancelled') {
            return 'project_cancelled';
        }
        if ($project->status === 'project_paused') {
            return 'project_paused';
        }
        if ($project->status === 'project_completed' || $project->status === 'awaiting_your_review') {
            return 'project_completed';
        }

        if($project->status === 'estimation') {
            $estimate_recalled = Estimate::where('project_id', $project_id)
                                ->where('tradesperson_id', Auth::user()->id)
                                ->first();

            if (empty($estimate_recalled)) {
                return 'write_estimate';
            }
            if ($estimate_recalled->project_awarded == 0 && $estimate_recalled->status == 'estimate_recalled') {
                return 'estimate_recalled';
            }
            if ($estimate_recalled->project_awarded == 0 && $estimate_recalled->status == null && strtolower($estimate_recalled->unable_to_describe_type) == 'need_more_info') {
                return 'need_more_info';
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
    $tasks = Task::where('estimate_id', $estimate->id)->get();
    //For notification
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
            'user_name'          => $user->name,
            'tasks'              => $tasks
            ])
            ->render();
        $emaildata = array(
            'From'          => env('MAIL_FROM_ADDRESS'),
            'To'            => $user->email,
            'Subject'       => 'Milestone completed',
            'HtmlBody'      => $html,
            'MessageStream' => 'outbound'
        );
        $email_sent = send_email($emaildata);
        $notificationDetail = new NotificationDetail();
        $notificationDetail->user_id = $user->id;
        $notificationDetail->from_user_id = Auth::user()->id;
        $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
        $notificationDetail->related_to = 'project';
        $notificationDetail->related_to_id = $project->id;
        $notificationDetail->read_status = 0;
        $notificationDetail->notification_text = 'Your '.$project->project_name.' milestone has been completed';
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
            'From'          =>  env('MAIL_FROM_ADDRESS'),
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
        $notificationDetail->notification_text = 'Your '.$project->project_name.' has been paused';
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
            'From'          =>  env('MAIL_FROM_ADDRESS'),
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
        $notificationDetail->notification_text = 'Customer has paused the project '.$project->project_name;
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
            'From'          =>  env('MAIL_FROM_ADDRESS'),
            'To'            =>  $tradeperson->email,
            'Subject'       => 'Your given estimate has been rejected',
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
        $notificationDetail->notification_text = 'Your given estimate for '.$project->project_name.' has been rejected';
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
            'From'          =>  env('MAIL_FROM_ADDRESS'),
            'To'            =>  $user->email,
            'Subject'       => 'Your project has been cancelled',
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
        $notificationDetail->notification_text = 'Your project '.$project->project_name.' has been cancelled';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}
function project_completed_notification($projectId){
    $project = Project::where('id', $projectId)->first();
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
            'From'          =>  env('MAIL_FROM_ADDRESS'),
            'To'            =>  $user->email,
            'Subject'       => 'Your '.$project->project_name.' project has been completed',
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
        $notificationDetail->notification_text = 'Your project '.$project->project_name.' has been completed';
        $notificationDetail->reviewer_note = null;
        $notificationDetail->save();
    }
}

if(!function_exists('recommended_projects')) {
    function recommended_projects($trader_areas, $trader_works) {
        $recommended_proj = Project::where( function($query) use($trader_areas, $trader_works) {
            $query->where('reviewer_status', 'approved')
                    ->distinct('projects.id')
                    ->whereHas('subCategories', function($query) use($trader_works) {
                        $query->whereIn('buildersubcategories.id', Arr::pluck($trader_works, 'buildersubcategory_id'));
                    })
                    ->whereDoesntHave('estimates', function ($query) {
                        $query->where('project_awarded', 1)
                              ->orWhere('estimates.status', 'trader_rejected');
                    })
                    ->where('projects.user_id', '<>', Auth::user()->id)
                    ->select('projects.*');
                    // ->join('traderareas', function($query) { $query->on(DB::raw('CONCAT(projects.county, projects.town)'), '=', DB::raw('CONCAT(traderareas.county, traderareas.town)'));});
            $query->where(function ($q) use ($trader_areas) {
                        foreach ($trader_areas as $trader_area) {
                            $q->orWhere(function ($subQuery) use ($trader_area) {
                                $subQuery->where('town', $trader_area->town)
                                ->where('county', $trader_area->county);
                            });
                        }
                    });

            $query->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review']);
        });
        return $recommended_proj;
    }
}


if(!function_exists('lock_trader_dashboard_access')) {
    // function lock_trader_dashboard_access() {
    //     $user = TraderDetail::where('user_id', Auth::id())->first();

    //     if (empty($user))
    //         return redirect()->route('tradepersion.compregistration');
    //     elseif (empty($user->contingency) || is_null($user->contingency))
    //         return redirect()->route('tradepersion.bankregistration');
    // }

    function lock_trader_dashboard_access() {
        $user = User::where('id', Auth::id())->first();
        if (Str::lower($user->customer_or_tradesperson) == 'customer')
            return redirect()->route('customer.profile');
        if ($user->steps_completed == 1)
            return redirect()->route('tradepersion.compregistration');
        elseif ($user->steps_completed == 2)
            return redirect()->route('tradepersion.bankregistration');
    }

    function get_notification_details(){
      $unread_notifications = NotificationDetail::where('read_status', 0)->where('user_id', Auth::id())->count();
      $notifications = NotificationDetail::where('user_id', Auth::id())->get();

      return ['unread_notifications'=>$unread_notifications, 'notifications'=>$notifications];
    }

    function sendSMS($user,$otp)
    {
        $receiverNumber = $user->phone;
        $message = "This is your Fix my build forget password OTP ".$otp;

        $account_sid = env("TWILIO_SID");
        $auth_token = env("TWILIO_TOKEN");
        $twilio_number = env("TWILIO_FROM");

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber, [
            'from' => $twilio_number,
            'body' => $message]);
    }

    if (! function_exists('prepareMetaData')) {
        function prepareMetaData($collection) {
            return [
                'current_page' => (int) @$collection->currentPage(),
                'last_page' => (int) @$collection->lastPage(),
                'from' => (int) @$collection->firstItem(),
                'to' => (int) @$collection->lastItem(),
                'total' => (int) @$collection->total(),
            ];
        }
    }

    if (! function_exists('parseOrderByColumn')) {
        function parseOrderByColumn($field)
        {
            $direction = 'asc';

            if (strpos($field, '-') !== false) {
                $field = substr($field, 1);
                $direction = 'desc';
            }

            return [
                'field' => $field,
                'direction' => $direction
            ];
        }
    }


    if (! function_exists('isCustomer')) {
        function isCustomer(string $userType) {
            return $userType == config('const.user_types.CUSTOMER');
        }
    }

    if (! function_exists('isTrader')) {
        function isTrader(string $userType) {
            return $userType == config('const.user_types.TRADESPERSON');
        }
    }

    if (! function_exists('getMediaType')) {
        function getMediaType(string $extension) {
            $image_ext = [
                "ase",
                "art",
                "bmp",
                "blp",
                "cd5",
                "cit",
                "cpt",
                "cr2",
                "cut",
                "dds",
                "dib",
                "djvu",
                "egt",
                "exif",
                "gif",
                "gpl",
                "grf",
                "icns",
                "ico",
                "iff",
                "jng",
                "jpeg",
                "jpg",
                "jfif",
                "jp2",
                "jps",
                "lbm",
                "max",
                "miff",
                "mng",
                "msp",
                "nef",
                "nitf",
                "ota",
                "pbm",
                "pc1",
                "pc2",
                "pc3",
                "pcf",
                "pcx",
                "pdn",
                "pgm",
                "PI1",
                "PI2",
                "PI3",
                "pict",
                "pct",
                "pnm",
                "pns",
                "ppm",
                "psb",
                "psd",
                "pdd",
                "psp",
                "px",
                "pxm",
                "pxr",
                "qfx",
                "raw",
                "rle",
                "sct",
                "sgi",
                "rgb",
                "int",
                "bw",
                "tga",
                "tiff",
                "tif",
                "vtf",
                "xbm",
                "xcf",
                "xpm",
                "3dv",
                "amf",
                "ai",
                "awg",
                "cgm",
                "cdr",
                "cmx",
                "dxf",
                "e2d",
                "egt",
                "eps",
                "fs",
                "gbr",
                "odg",
                "svg",
                "stl",
                "vrml",
                "x3d",
                "sxd",
                "v2d",
                "vnd",
                "wmf",
                "emf",
                "art",
                "xar",
                "png",
                "webp",
                "jxr",
                "hdp",
                "wdp",
                "cur",
                "ecw",
                "iff",
                "lbm",
                "liff",
                "nrrd",
                "pam",
                "pcx",
                "pgf",
                "sgi",
                "rgb",
                "rgba",
                "bw",
                "int",
                "inta",
                "sid",
                "ras",
                "sun",
                "tga",
                "heic",
                "heif"
            ];

            $video_ext = [
                "3g2",
                "3gp",
                "aaf",
                "asf",
                "avchd",
                "avi",
                "drc",
                "flv",
                "m2v",
                "m3u8",
                "m4p",
                "m4v",
                "mkv",
                "mng",
                "mov",
                "mp2",
                "mp4",
                "mpe",
                "mpeg",
                "mpg",
                "mpv",
                "mxf",
                "nsv",
                "ogg",
                "ogv",
                "qt",
                "rm",
                "rmvb",
                "roq",
                "svi",
                "vob",
                "webm",
                "wmv",
                "yuv"
            ];

            if ( in_array($extension, $image_ext) )
                return 'image';
            elseif ( in_array($extension, $video_ext) )
                return 'video';

            return 'document';
        }
    }
}
