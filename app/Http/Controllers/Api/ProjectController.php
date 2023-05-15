<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $response){
        $projects = Project::with('projectaddress')->get();

        return response()->json($projects, 200);
    }
}
