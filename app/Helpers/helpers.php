<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buildercategory;
use App\Models\Project;
use App\Models\Buildersubcategory;
use App\Models\Estimate;
use Illuminate\Support\Facades\Auth;
use Hashids\Hashids;

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

            if ($estimate_recalled->isEmpty()) {
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
