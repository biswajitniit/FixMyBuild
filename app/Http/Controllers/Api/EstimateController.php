<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Estimate;
use App\Models\Task;
use App\Models\ProjectEstimateFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Traderareas;
use App\Models\ProjectCategory;
use App\Models\Traderworks;
use App\Models\User;
use App\Models\UserPersonalDataShare;
use App\Models\ProjectStatusChangeLog;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Http\Resources\EstimateCollection;

class EstimateController extends BaseController
{
    private function reject_estimate_notification($estimate_id)
    {
        $estimate = Estimate::findOrFail($estimate_id);
        $project = $estimate->project;
        $user = User::findOrFail($estimate->tradesperson_id);

        // Check Notification settings
        $notify_settings = Notification::where('user_id', $user->id)->first();
        $noti_cancelled = 1;

        if ($notify_settings && $notify_settings->settings != null) {
            $noti_cancelled = $notify_settings->settings['noti_project_cancelled'];
        }

        // Notification
        if ($noti_cancelled == 1) {
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
            send_email($emaildata);

            $notificationDetail = new NotificationDetail();
            $notificationDetail->user_id = $user->id;
            $notificationDetail->from_user_id = request()->user()->id;
            $notificationDetail->from_user_type = request()->user()->customer_or_tradesperson;
            $notificationDetail->related_to = 'project';
            $notificationDetail->related_to_id = $project->id;
            $notificationDetail->read_status = 0;
            $notificationDetail->notification_text = 'Your project '.$project->project_name.' has been cancelled';
            $notificationDetail->reviewer_note = null;
            $notificationDetail->save();
        }
    }


    // Customer Estimate Listing API
    public function index($project)
    {
        try {
            $project = Project::findorFail($project);
            $estimates = Estimate::where('project_id', $project->id)->where('status', '<>', 'estimate_recalled')->with('tradesperson.traderDetail')->get();

            // Trader Counts
            // $trader_who_submitted_estimate = array_column($estimates, 'tradesperson_id');
            $trader_who_submitted_estimate = $estimates->pluck('tradesperson_id');
            $trader_id_matched_areas = Traderareas::where(['county' => $project->county, 'town' => $project->town])->whereNotIn('user_id', $trader_who_submitted_estimate)->pluck('user_id');
            $project_categories = ProjectCategory::where('project_id', $project->id)->pluck('sub_category_id');
            $remainingTraderCount = Traderworks::whereIn('buildersubcategory_id', $project_categories)->whereIn('user_id', $trader_id_matched_areas)->count();

            $combinedData = [
                'remaining_trader_count' => $remainingTraderCount,
                'estimates' => new EstimateCollection($estimates)
            ];

            if ($project->user_id == request()->user()->id) {
                return $this->success($combinedData);
            }

            return $this->error('You are not authorized to view the estimates of this project.', 403);
        } catch (ModelNotFoundException $e) {
            return $this->error('Project not found.', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


    // Trader Write Estimate
    public function store(Request $request, int $project_id)
    {
        $validator = Validator::make($request->all(), [
            'describe_mode' => ['required', 'string', Rule::in(config('const.describe_mode'))],
            'unable_to_describe_type' => [
                'required_if:describe_mode,'.config('const.describe_mode.UNABLE_TO_DESCRIBE'),
                'string',
                Rule::in(config('const.unable_to_describe_type'))
            ],
            'tasks' => [
                'required_if:describe_mode,'.config('const.describe_mode.FULLY_DESCRIBE'),
                'string'
            ],
            'more_info' => [
                'required_if:unable_to_describe_type,'.config('const.unable_to_describe_type.NEED_MORE_INFO'),
                'string'
            ],
            'contingency' => ['required', 'numeric', 'min:0', 'max:100'],
            'apply_vat' => ['required', 'boolean'],
            'cover_all_works' => ['required', 'boolean'],
            'payment_required_upfront' => ['required', 'boolean'],
            'initial_payment' => [
                'required_if:payment_required_upfront,true',
                'array'
            ],
            'initial_payment.value' => [
                'required_if:payment_required_upfront,true',
                'numeric',
                'min:0'
            ],
            'initial_payment.type' => [
                'required_if:payment_required_upfront,true',
                'string',
                Rule::in(config('const.initial_payment_type'))
            ],
            'time_required' => ['required', 'array'],
            'time_required.duration' => ['required', 'string'],
            'time_required.unit' => ['required', 'string', Rule::in(config('const.time_unit'))],
            'start_date' => ['required', 'array'],
            'start_date.type' => ['required', 'string', Rule::in(config('const.start_date_type'))],
            'start_date.time' => [
                'required_if:start_date.type,'.config('const.start_date_type.SPECIFIC_DATE'),
                'date_format:Y-m-d'
            ],
            'terms_and_condition' => ['nullable', 'string'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimetypes:'.str_replace(" ", "", config('const.dropzone_accepted_image'))]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $tasks = json_decode($request->input('tasks'), true);
        } catch (Exception $e) {
            return $this->error('Decode error!', 403);
        }

        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error('Forbidden!', 403);
            }

            $estimate_previously_submitted = Estimate::where(['tradesperson_id'=> $request->user()->id, 'project_id' => $project_id])->count() > 0 ? true : false;

            if ($estimate_previously_submitted) {
                return $this->error('Forbidden! You have previously submitted estimate for this project.', 403);
            }

            DB::beginTransaction();

            $project = Project::findOrFail($project_id);
            $estimate = Estimate::create([
                'project_id' => $project->id,
                'tradesperson_id' => $request->user()->id,
                'describe_mode' => $request->input('describe_mode'),
                'unable_to_describe_type' => $request->input('unable_to_describe_type'),
                'more_info' => $request->input('more_info'),
                'covers_customers_all_needs' => $request->input('cover_all_works'),
                'payment_required_upfront' => $request->input('payment_required_upfront'),
                'apply_vat' => $request->input('apply_vat'),
                'contingency' => $request->input('contingency'),
                'initial_payment' => $request->input('initial_payment.value'),
                'initial_payment_type' => $request->input('initial_payment.type'),
                'project_start_date' => $request->input('start_date.time'),
                'project_start_date_type' => $request->input('start_date.type'),
                'total_time' => $request->input('time_required.duration'),
                'total_time_type' => $request->input('time_required.unit'),
                'terms_and_conditions' => $request->input('terms_and_condition'),
            ]);

            if ($request->input('payment_required_upfront')) {
                Task::create([
                    'estimate_id' => $estimate->id,
                    'description' => 'initial payment',
                    'price'       => $request->input('initial_payment.value'),
                    'is_initial'  => true,
                    'contingency' => $request->input('contingency'),
                    'max_contingency' => $request->input('contingency'),
                ]);
            }

            foreach ($tasks as $task) {
                Task::create([
                    'description' => $task['description'],
                    'price' => $task['price'],
                    'estimate_id' => $estimate->id,
                    'contingency' => $request->input('contingency'),
                    'max_contingency' => $request->input('contingency'),
                    'is_initial' => false,
                ]);
            }

            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $extension = $image->getClientOriginalExtension();
                    $s3FileName = Str::uuid().'.'.$extension;
                    Storage::disk('s3')->put(config('const.s3ProjectFolderName').$s3FileName, file_get_contents($image->getRealPath()));
                    $url = Storage::disk('s3')->url(config('const.s3ProjectFolderName').$s3FileName);

                    ProjectEstimateFile::create([
                        'estimate_id' => $estimate->id,
                        'file_name' => $image->getClientOriginalName(),
                        'file_original_name' => $image->getClientOriginalName(),
                        'file_extension' => $extension,
                        'url' => $url,
                        'file_type' => getMediaType($extension),
                    ]);
                }
            }

            DB::commit();

            return $this->success('Estimate Submitted Successfully!');
        } catch (Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage(), 500);
        }
    }


    public function show(int $id)
    {
        try {
            $estimate = Estimate::where('id', $id)->with('tasks', 'files', 'tradesperson.traderDetail')->firstOrFail();
            if ($estimate->tradesperson_id == request()->user()->id || @$estimate->project->user_id == request()->user()->id) {
                return $this->success($estimate);
            }

            return $this->error('Forbidden', 403);
        } catch (ModelNotFoundException $e) {
            return $this->error('Estimate not found.', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


    public function update(Request $request, int $project_id)
    {
        $validator = Validator::make($request->all(), [
            'describe_mode' => ['required', 'string', Rule::in(config('const.describe_mode'))],
            'unable_to_describe_type' => [
                'required_if:describe_mode,'.config('const.describe_mode.UNABLE_TO_DESCRIBE'),
                'string',
                Rule::in(config('const.unable_to_describe_type'))
            ],
            'tasks' => [
                'required_if:describe_mode,'.config('const.describe_mode.FULLY_DESCRIBE'),
                'array'
            ],
            'tasks.*' => [
                'required_if:describe_mode,'.config('const.describe_mode.FULLY_DESCRIBE'),
                'array'
            ],
            'tasks.*.description' => [
                'required_if:describe_mode,'.config('const.describe_mode.FULLY_DESCRIBE'), 'string'
            ],
            'tasks.*.price' => [
                'required_if:describe_mode,'.config('const.describe_mode.FULLY_DESCRIBE'), 'numeric'
            ],
            'more_info' => [
                'required_if:unable_to_describe_type,'.config('const.unable_to_describe_type.NEED_MORE_INFO'),
                'string'
            ],
            'contingency' => ['required', 'numeric', 'min:0', 'max:100'],
            'apply_vat' => ['required', 'boolean'],
            'cover_all_works' => ['required', 'boolean'],
            'payment_required_upfront' => ['required', 'boolean'],
            'initial_payment' => [
                'required_if:payment_required_upfront,true',
                'array'
            ],
            'initial_payment.value' => [
                'required_if:payment_required_upfront,true',
                'numeric',
                'min:0'
            ],
            'initial_payment.type' => [
                'required_if:payment_required_upfront,true',
                'string',
                Rule::in(config('const.initial_payment_type'))
            ],
            'time_required' => ['required', 'array'],
            'time_required.duration' => ['required', 'string'],
            'time_required.unit' => ['required', 'string', Rule::in(config('const.time_unit'))],
            'start_date' => ['required', 'array'],
            'start_date.type' => ['required', 'string', Rule::in(config('const.start_date_type'))],
            'start_date.time' => [
                'required_if:start_date.type,'.config('const.start_date_type.SPECIFIC_DATE'),
                'date_format:Y-m-d'
            ],
            'terms_and_condition' => ['nullable', 'string'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimetypes:'.str_replace(" ", "", config('const.dropzone_accepted_image'))]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error('Forbidden!', 403);
            }

            DB::beginTransaction();

            $project = Project::findOrFail($project_id);
            $estimate = Estimate::where(['project_id' => $project->id, 'tradesperson_id' => $request->user()->id])->firstOrFail();

            $estimate->update([
                'project_id' => $project->id,
                'tradesperson_id' => $request->user()->id,
                'describe_mode' => $request->input('describe_mode'),
                'unable_to_describe_type' => $request->input('unable_to_describe_type'),
                'more_info' => $request->input('more_info'),
                'covers_customers_all_needs' => $request->input('cover_all_works'),
                'payment_required_upfront' => $request->input('payment_required_upfront'),
                'apply_vat' => $request->input('apply_vat'),
                'contingency' => $request->input('contingency'),
                'initial_payment' => $request->input('initial_payment.value'),
                'initial_payment_type' => $request->input('initial_payment.type'),
                'project_start_date' => $request->input('start_date.time'),
                'project_start_date_type' => $request->input('start_date.type'),
                'total_time' => $request->input('time_required.duration'),
                'total_time_type' => $request->input('time_required.unit'),
                'terms_and_conditions' => $request->input('terms_and_condition'),
            ]);

            Task::where('estimate_id', $estimate->id)->forceDelete();

            if ($request->input('payment_required_upfront')) {
                Task::create([
                    'estimate_id' => $estimate->id,
                    'description' => 'initial payment',
                    'price'       => $request->input('initial_payment.value'),
                    'is_initial'  => true,
                ]);
            }

            foreach ($request->input('tasks') as $task) {
                Task::create([
                    'description' => $task['description'],
                    'price' => $task['price'],
                    'estimate_id' => $estimate->id,
                    'contingency' => $request->input('contingency'),
                    'max_contingency' => $request->input('contingency'),
                    'is_initial' => false,
                ]);
            }

            // Delete Old Medias From S3
            $old_medias = ProjectEstimateFile::where('estimate_id', $estimate->id)->pluck('url');
            $media_paths = $old_medias->map(function ($url) {
                return parse_url($url, PHP_URL_PATH);
            })->toArray();
            Storage::disk('s3')->delete($media_paths);

            ProjectEstimateFile::where('estimate_id', $estimate->id)->forceDelete();

            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $extension = $image->getClientOriginalExtension();
                    $s3FileName = Str::uuid().'.'.$extension;
                    Storage::disk('s3')->put(config('const.s3ProjectFolderName').$s3FileName, file_get_contents($image->getRealPath()));
                    $url = Storage::disk('s3')->url(config('const.s3ProjectFolderName').$s3FileName);

                    ProjectEstimateFile::create([
                        'estimate_id' => $estimate->id,
                        'file_name' => $image->getClientOriginalName(),
                        'file_original_name' => $image->getClientOriginalName(),
                        'file_extension' => $extension,
                        'url' => $url,
                        'file_type' => getMediaType($extension),
                    ]);
                }
            }

            DB::commit();

            return $this->success('Estimate Updated Successfully!');
        } catch (Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage(), 500);
        }
    }


    // Accept estimate by customer
    public function accept(Request $request, int $estimate)
    {
        $request->validate([
            "name" => ['required', 'boolean'],
            "address" => ['required', 'boolean'],
            "home_phone" => ['required', 'boolean'],
            "mobile_phone" => ['required', 'boolean'],
            "email" => ['required', 'boolean'],
        ]);

        try {
            $estimate = Estimate::find($estimate);

            if (!$estimate) {
                return $this->error('Estimate not found.', 404);
            }

            $tradesperson = $estimate->tradesperson;
            $project = $estimate->project;
            $user_personal_data = UserPersonalDataShare::where('project_id', $project->id)->first();

            $settings = [
                "name" => $request->name,
                "address" => $request->address,
                "home_phone" => $request->home_phone,
                "mobile_phone" => $request->mobile_phone,
                "email" => $request->email,
            ];

            if ($project->user_id != $request->user()->id) {
                return $this->error('You are not authorized to accept this estimation!', 403);
            }

            if ($project->status != config('const.project_status.ESTIMATION')) {
                return $this->error('You can only accept estimate for projects which are in estimation state!', 400);
            }

            DB::beginTransaction();

            $project->update(['status' => config('const.project_status.PROJECT_STARTED')]);
            $estimate->update(['project_awarded' => 1, 'status' => 'awarded']);

            //Insert data in project_status_change_log table
            $projStatusChangeLog = new ProjectStatusChangeLog();
            $projStatusChangeLog->project_id = $project->id;
            $projStatusChangeLog->action_by_id = $request->user()->id;
            $projStatusChangeLog->action_by_type = 'user';
            $projStatusChangeLog->status = config('const.project_status.PROJECT_STARTED');
            $projStatusChangeLog->status_changed_at = now();
            $projStatusChangeLog->save();

            //Insert data in user_personal_data_shares table
            if ($user_personal_data) {
                $user_personal_data->settings = $settings;
                $user_personal_data->save();
            } else {
                $userPersonalData = new UserPersonalDataShare();
                $userPersonalData->user_id = $request->user()->id;
                $userPersonalData->project_id = $project->id;
                $userPersonalData->tradeperson_id = $tradesperson->id;
                $userPersonalData->settings = $settings;
                $userPersonalData->save();
            }

            // Check Notification settings
            $notify_settings = Notification::where('user_id', $tradesperson->id)->first();
            $noti_accepted = 1;
            if ($notify_settings && $notify_settings->settings) {
                $noti_accepted = $notify_settings->settings['noti_quote_accepted'];
            }

            // Notification
            if ($noti_accepted == 1) {
                $html = view('email.estimate-accepted-email')
                    ->with('data', [
                        'project_name'       => $project->project_name,
                        'user_name'          => $tradesperson->name
                    ])
                    ->render();

                $emaildata = array(
                    'From'          =>  env('MAIL_FROM_ADDRESS'),
                    'To'            =>  $tradesperson->email,
                    'Subject'       => 'Your given estimate has been accepted',
                    'HtmlBody'      =>  $html,
                    'MessageStream' => 'outbound'
                );

                send_email($emaildata);

                $notificationDetail = new NotificationDetail();
                $notificationDetail->user_id = $tradesperson->id;
                $notificationDetail->from_user_id = $request->user()->id;
                $notificationDetail->from_user_type = $request->user()->customer_or_tradesperson;
                $notificationDetail->related_to = 'project';
                $notificationDetail->related_to_id = $project->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'Your given estimate has been accepted';
                $notificationDetail->reviewer_note = null;
                $notificationDetail->save();
            }

            // Send mails to the traders whose estimates were not accepted
            $unsuccessful_traders = Estimate::where('tradesperson_id', '<>', $tradesperson->id)
                ->where('project_id', $project->id)
                ->select('tradesperson_id')
                ->get();
            $unsuccessful_traders_mail = User::whereIn('id', array_column($unsuccessful_traders->toArray(), 'tradesperson_id'))->pluck('email');

            foreach ($unsuccessful_traders_mail as $mail) {
                $html = view('email.project-unsuccessful')
                    ->with('data', [
                        'logo' => asset('frontend/emailtemplateimage/project-unsuccessful.svg'),
                        'heading' => 'Project unsuccessful',
                        'project_name' => $project->project_name,
                    ])
                    ->render();

                $emaildata = array(
                    'From'          =>  env('MAIL_FROM_ADDRESS'),
                    'To'            =>  $mail,
                    'Subject'       => 'Your given estimate has been unsuccessful',
                    'HtmlBody'      =>  $html,
                    'MessageStream' => 'outbound'
                );

                send_email($emaildata);
            }

            DB::commit();

            return $this->success('Estimate has been accepted successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }


    // Reject estimate by customer
    public function reject(Request $request, $estimate)
    {
        try {
            $estimate = Estimate::find($estimate);

            if (!$estimate) {
                return $this->error('Estimate not found.', 404);
            }

            $tradesperson = $estimate->tradesperson;
            $project = $estimate->project;

            if ($project->user_id != $request->user()->id) {
                return $this->error('You are not authorized to reject this estimation!', 403);
            }

            if ($project->status != config('const.project_status.ESTIMATION')) {
                return $this->error('You can only reject estimate for projects which are in estimation state!', 400);
            }

            DB::beginTransaction();
            $estimate->status = 'rejected';
            $estimate->save();
            $this->reject_estimate_notification($estimate->id);
            DB::commit();

            return $this->success('Estimate has been successfully rejected.');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }


    // Trader recalls an estimate
    public function recall(Request $request, $estimate)
    {
        try {
            $estimate = Estimate::find($estimate);

            if (!$estimate) {
                return $this->error('Estimate not found.', 404);
            }

            if ($estimate->tradesperson_id != $request->user()->id) {
                return $this->error('You are not authorized to recall this estimation!', 403);
            }

            if ($estimate->project->status != config('const.project_status.ESTIMATION')) {
                return $this->error('You can only recall estimate for projects which are in estimation state!', 400);
            }

            $estimate->status = 'estimate_recalled';
            $estimate->save();

            return $this->success('Estimate has been successfully recalled.');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    public function destroy($id)
    {
        //
    }
}
