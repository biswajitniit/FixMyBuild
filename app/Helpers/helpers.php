<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buildercategory;
use App\Models\Buildersubcategory;
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

    function time_diff($created_at)
    {
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
