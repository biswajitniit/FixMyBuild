<?php

namespace App\Http\Controllers\Admin\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Projectfile;
use App\Models\Projectaddresses;
use App\Models\Buildercategory;
use App\Models\Buildersubcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Models\ProjectStatusChangeLog;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReviewerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awaiting_your_review(){
        $project = Project::all();
        return view("admin.reviewer.awaiting-your-review",compact('project'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awaiting_your_review_show(Request $request, $projectid){
      //echo Hashids_decode($projectid); die;
        $project = Project::where('id',Hashids_decode($projectid))->first();
        //dd($project);
        $projectmedia = Projectfile::where('project_id',Hashids_decode($projectid))->get();
        $buildercategory = Buildercategory::where('status','Active')->get();

        return view("admin.reviewer.awaiting-your-review-show",compact('project','projectmedia','buildercategory'));
    }

    /**
     * Submited for review show.
     *
     * @return \Illuminate\Http\Response
     */

    public function awaiting_your_review_save(Request $request)
    {
        $request->validate([
            'reviewer_status' => 'required',
        ]);

        $status = null;
        if($request->post('reviewer_status') == "approved"){
            $status = 'estimation';
        } elseif($request->post('reviewer_status') == "referred"){
            $status = 'returned_for_review';
        }
        $builder_category = null;
        if($request->post('builder_category')){
            $builder_category =  implode(',',$request->post('builder_category'));
        }
        $builder_subcategory = null;
        if($request->post('builder_subcategory')){
            $builder_subcategory =  implode(',',$request->post('builder_subcategory'));
        }
            $data = array(
                'reviewer_status'          => $request->post('reviewer_status'), // Approve Or Referred
                'categories'               => $builder_category,
                'subcategories'            => $builder_subcategory,
                'customer_note'            => $request->post('notes_for_customer'),
                'tradeperson_note'         => $request->post('notes_for_tradespeople'),
                'internal_note'            => $request->post('notes_for_internal'),
                'status'                   => $status
            );
            Project::where('id', $request->projectid)->update($data);

        $old_categories = ProjectCategory::where('project_id', $request->projectid)->get();

        foreach ($request->post('builder_subcategory') as $sub_category) {
            ProjectCategory::create([
                'project_id'      => $request->projectid,
                'sub_category_id' => $sub_category,
            ]);
        }

        // Delete old categories
        foreach ($old_categories as $old_category) {
          $old_category->delete();
        }

        $notes_for_customer = $request->input('notes_for_customer');
        $reviewer_status = $request->input('reviewer_status');
        $project = Project::where('id', $request->projectid)->first();
        $user = User::where('id', $project->user_id)->first();

        // Check Notification settings
        $notify_settings = Notification::where('user_id', $user->id)->first();
        if($notify_settings) {
            if($notify_settings->settings != null){
                $project_reviewed = $notify_settings->settings['reviewed'];
            } else {
                $project_reviewed = 1;
            }
        }
        // Notification
        if($project_reviewed == 1){
            if($request->post('reviewer_status') == "approved"){

                $html = view('email.email-project-reviewed')
                                ->with('data', [
                                'notes_for_customer' => $notes_for_customer,
                                'project_name'       => $project->project_name,
                                'user_name'          => $user->name,
                                'reviewer_status'    => $reviewer_status
                                ])
                                ->render();
                $emaildata = array(
                    'From'          => env('MAIL_FROM_ADDRESS'),
                    'To'            => $user->email,
                    'Subject'       => 'Your Project Approved',
                    'HtmlBody'      => $html,
                    'MessageStream' => 'outbound'
                );
                $email_sent = send_email($emaildata);

                // Notificatin Insert in DB
                $notificationDetail = new NotificationDetail();
                $notificationDetail->user_id = $user->id;
                $notificationDetail->from_user_id = Auth::user()->id;
                $notificationDetail->from_user_type = Auth::user()->type;
                $notificationDetail->related_to = 'project';
                $notificationDetail->related_to_id = $project->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'Your '.$project->project_name.' has been reviewed';
                $notificationDetail->reviewer_note = $notes_for_customer;
                $notificationDetail->save();
                 //Insert data in project_status_change_log table
                $projStatusChangeLog = new ProjectStatusChangeLog();
                $projStatusChangeLog->project_id = $project->id;
                $projStatusChangeLog->action_by_id = Auth::user()->id;
                $projStatusChangeLog->action_by_type = Auth::user()->type;
                $projStatusChangeLog->status = $request->post('reviewer_status');
                $projStatusChangeLog->status_changed_at = Carbon::now();
                $projStatusChangeLog->save();
            } else{
                    $html = view('email.email-project-reviewed')
                                ->with('data', [
                                    'notes_for_customer' => $notes_for_customer,
                                    'project_name'       => $project->project_name,
                                    'user_name'          => $user->name,
                                    'reviewer_status'    => $reviewer_status
                                    ])
                                ->render();
                    $emaildata = array(
                        'From'          => env('MAIL_FROM_ADDRESS'),
                        'To'            => $user->email,
                        'Subject'       => 'Your Project Reviewed',
                        'HtmlBody'      => $html,
                        'MessageStream' => 'outbound'
                    );
                    $email_sent = send_email($emaildata);

                    // Notificatin Insert in DB
                    $notificationDetail = new NotificationDetail();
                    $notificationDetail->user_id = $user->id;
                    $notificationDetail->from_user_id = Auth::user()->id;
                    $notificationDetail->from_user_type = Auth::user()->type;
                    $notificationDetail->related_to = 'project';
                    $notificationDetail->related_to_id = $project->id;
                    $notificationDetail->read_status = 0;
                    $notificationDetail->notification_text = 'Your '.$project->project_name.' has been reviewed';
                    $notificationDetail->reviewer_note = $notes_for_customer;
                    $notificationDetail->save();
                    //Insert data in project_status_change_log table
                    $projStatusChangeLog = new ProjectStatusChangeLog();
                    $projStatusChangeLog->project_id = $project->id;
                    $projStatusChangeLog->action_by_id = Auth::user()->id;
                    $projStatusChangeLog->action_by_type = Auth::user()->type;
                    $projStatusChangeLog->status = $request->post('reviewer_status');
                    $projStatusChangeLog->status_changed_at = Carbon::now();
                    $projStatusChangeLog->save();
            }
        }

        return redirect()->route('admin/project/awaiting-your-review');
    }

    public function awaiting_your_review_final_save(Request $request){
        $data = array(
            //'reviewer_status'          => 'Approve'
        );
        Project::where('id', $request->projectid)->update($data);
        return redirect()->route('admin/project/awaiting-your-review');
    }

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
                                echo '<div class="mt-1">
                                        <div class="form-check">
                                            <input type="checkbox" name="builder_subcategory[]" class="form-check-input" id="subcat'.$rowsubcat->id.'" value="'.$rowsubcat->id.'"/>
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
