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
use App\Models\Projectnotesandcommend;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\NotificationDetail;
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
        $projectnotesandcommend = Projectnotesandcommend::where('project_id',Hashids_decode($projectid))->get();
        $projectmedia = Projectfile::where('project_id',Hashids_decode($projectid))->get();
        $buildercategory = Buildercategory::where('status','Active')->get();

        $projectnotesandcommend = Projectnotesandcommend::where('project_id',Hashids_decode($projectid))->get();
        return view("admin.reviewer.awaiting-your-review-show",compact('project','projectmedia','buildercategory','projectnotesandcommend'));
    }

    /**
     * Submited for review show.
     *
     * @return \Illuminate\Http\Response
     */
    public function awaiting_your_review_save(Request $request){

       if($request->post('builder_category')){
            $data = array(
                'reviewer_status'          => $request->post('your_decision'),
                'categories'               => implode(',',$request->post('builder_category')),
                'subcategories'            => implode(',',$request->post('builder_subcategory'))
            );
            Project::where('id', $request->projectid)->update($data);

            $notes_for_customer = $request->input('notes_for_customer');
            $approve_or_refer = $request->input('approve_or_refer');
            $project = Project::where('id', $request->projectid)->first();
            $user = User::where('id', $project->user_id)->first();

            // Check Notification settings
            $notify_settings = Notification::where('user_id', $user->id)->first();
            if ($notify_settings) {
              if($notify_settings->settings != null){
                $arr_notify_settings = json_decode($notify_settings->settings, true);$project_reviewed = $arr_notify_settings['reviewed'];
              } else {
                $project_reviewed = 1;
              }
            }
            // Notification
            $notes_for_customer = $request->input('notes_for_customer');
            $project = Project::where('id', $request->projectid)->first();

            if($request->post('your_decision') == "Approve"){ //
              $data = array(
                'status'          => 'estimation'
              );
              Project::where('id', $request->projectid)->update($data);
              if($project_reviewed == 1){
                $html = view('email.email-project-reviewed')
                              ->with('data', [
                                'notes_for_customer' => $notes_for_customer,
                                'project_name'       => $project->project_name,
                                'user_name'          => $user->name,
                                'approve_or_refer'   =>$approve_or_refer
                                ])
                              ->render();
                $emaildata = array(
                    'From'          => 'support@fixmybuild.com',
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
                $notificationDetail->from_user_type = 'reviewer';
                $notificationDetail->related_to = 'project';
                $notificationDetail->related_to_id = $project->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'Your project has been reviewed';
                $notificationDetail->save();
              }
            } else{
              if($project_reviewed == 1){
                $html = view('email.email-project-reviewed')
                            ->with('data', [
                              'notes_for_customer' => $notes_for_customer,
                              'project_name'       => $project->project_name,
                              'user_name'          => $user->name
                              ])
                            ->render();
                $emaildata = array(
                  'From'          => 'support@fixmybuild.com',
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
                $notificationDetail->from_user_type = 'reviewer';
                $notificationDetail->related_to = 'project';
                $notificationDetail->related_to_id = $project->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'Your project has been reviewed';
                $notificationDetail->save();
              }
            }

       }else{
            $data = array(
                'reviewer_status'          => $request->post('your_decision')
            );
            Project::where('id', $request->projectid)->update($data);

            if($request->post('your_decision') == "Approve"){ //
                $data = array(
                    'status'          => 'estimation'
                );
                Project::where('id', $request->projectid)->update($data);
            }

       }
       // if record exist in then delete
        Projectnotesandcommend::where('project_id',$request->post('projectid'))->delete();

        // Notes for Internal
        $projectnotes = new Projectnotesandcommend();
            $projectnotes->reviewer_id =  Auth::guard('admin')->user()['id'];
            $projectnotes->project_id  =  $request->post('projectid');
            $projectnotes->notes_for   =  'internal';
            $projectnotes->notes       =  $request->post('notes_for_internal');
        $projectnotes->save();

        // Notes for Customer
        $projectnotes = new Projectnotesandcommend();
            $projectnotes->reviewer_id =  Auth::guard('admin')->user()['id'];
            $projectnotes->project_id  =  $request->post('projectid');
            $projectnotes->notes_for   =  'customer';
            $projectnotes->notes       =  $request->post('notes_for_customer');
        $projectnotes->save();

        // Notes for Tradespeople
        $projectnotes = new Projectnotesandcommend();
            $projectnotes->reviewer_id =  Auth::guard('admin')->user()['id'];
            $projectnotes->project_id  =  $request->post('projectid');
            $projectnotes->notes_for   =  'tradespeople';
            $projectnotes->notes       =  $request->post('notes_for_tradespeople');
        $projectnotes->save();

        return redirect()->route('final-review', [Hashids_encode($request->post('projectid'))]);

    }

    public function final_review($projectid){
        $projectnotesandcommend = Projectnotesandcommend::where('project_id',Hashids_decode($projectid))->get();
        return view("admin.reviewer.final-review",compact('projectnotesandcommend'));
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
