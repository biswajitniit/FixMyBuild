<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Projectfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'project_address_id' => 'required|string',
            'forename' => 'required|string',
            'surname' => 'required|string',
            'project_name' => 'required|string',
            'description' => 'required|string',
            'contact_mobile_no' => 'required|string',
            'contact_email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $result = Project::create([
                'project_address_id' => $request->project_address_id,
                'forename' => $request->forename,
                'surname' => $request->surname,
                'project_name' => $request->project_name,
                'description' => $request->description,
                'contact_mobile_no' => $request->contact_mobile_no,
                'contact_email' => $request->contact_email,
            ]);
            if (!$result) {
                throw ValidationException::withMessages(['message' => 'Something went wrong, please try again!'], 400);
            }
            return response()->json(['message'=>'Address saved successfully'],200);
        } catch(Exception $e){
            return response()->json($e,500);
        }
    }

    public function update_project(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $project =Project::where('id',$request->id);
            $project->project_address_id = $request->project_address_id;
            $project->forename = $request->forename;
            $project->surname = $request->surname;
            $project->project_name = $request->project_name;
            $project->description = $request->description;
            $project->contact_mobile_no = $request->contact_mobile_no;
            $project->contact_email = $request->contact_email;
            if(!$project->save()){
                return response()->json(['message'=>'Unexpected error, please try after sometimes'],400);
            }
            return response()->json(['message'=>"Project updated successfully"], 200);
        } catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    public function get_file(Request $request){
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|Project',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $files = Projectfile::where('project_id',$request->project_id)->get();
            if(!$files){
                return response()->json(['message'=>'Unexpected error, please try after sometimes'],400);
            }
            return response()->json($files, 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    public function add_file(Request $request){
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|Project',
            'file_name' => 'required',
            'file_extention' => 'required',
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $projectFile = new Projectfile();
        $projectFile->project_id = $request->project_id;
        $projectFile->filename = $request->file_name;
        $projectFile->file_extention = $request->file_extention;
        $projectFile->url = $request->url;

        if(!$projectFile->save()){
            return response()->json(['message'=>'Unexpected error, please try after sometimes'],400);
        }
        return response()->json(['message'=>"File uploaded successfully"], 200);
    }
}
