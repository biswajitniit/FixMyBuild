<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buildercategory;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function get_builders(Request $request){
        $data = Buildercategory::with('buildersubcategories')->get();
        return response()->json($data,200);
    }
}
