<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buildercategory;
use App\Models\Buildersubcategory;
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

