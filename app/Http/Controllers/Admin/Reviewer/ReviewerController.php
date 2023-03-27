<?php

namespace App\Http\Controllers\Admin\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Projectfile;
use App\Models\Projectaddresses;
use App\Models\Buildercategory;
use App\Models\Buildersubcategory;
use Illuminate\Support\Facades\DB;

class ReviewerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awaiting_your_review(){
        $project = Project::where('Status','Submitted for review')->get();
        return view("admin.reviewer.awaiting-your-review",compact('project'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awaiting_your_review_show(Request $request, $projectid){
        $project = Project::where('id',$projectid)->first();
        $buildercategory = Buildercategory::where('status','Active')->get();
        return view("admin.reviewer.awaiting-your-review-show",compact('project','buildercategory'));
    }

    /**
     * Submited for review show.
     *
     * @return \Illuminate\Http\Response
     */
    // public function submitted_for_review_show(Request $request, $projectid){

    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_builder_subcategory_list(Request $request){
        if(!empty($request->catid)){
            foreach($request->catid as $catid){
                $buildercategory = Buildercategory::where('id', $catid)->get();
                if($buildercategory){
                    foreach($buildercategory as $rowcat){
                        echo '<h4 class="header-title mt-3">'.$rowcat->builder_category_name.'</h4>';
                        $buildersubcategory = Buildersubcategory::where('builder_category_id', $catid)->get();
                        if($buildersubcategory){
                            foreach($buildersubcategory as $rowsubcat){
                                echo '<div class="mt-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" id="subcat'.$rowsubcat->id.'" value="'.$rowsubcat->id.'"/>
                                            <label class="form-check-label" for="customCheck'.$rowsubcat->id.'">'.$rowsubcat->builder_subcategory_name.'</label>
                                        </div>
                                    </div>';
                            }
                        }
                    }
                }
            }
        }
    }



}
