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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EstimateController extends BaseController
{
    public function index()
    {
        //
    }

    public function store(Request $request, int $project_id)
    {

        // dd($request->data);
        // dd(gettype($request->data));

        if (!isTrader($request->user()->customer_or_tradesperson)) {
            return $this->error('Forbidden!', 403);
        }

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

            if ($request->input('images')) {
                foreach ($request->input('images') as $image) {
                    $extension = $image->getClientOriginalExtension();
                    $s3FileName = Str::uuid().'.'.$extension;
                    Storage::disk('s3')->put(config('const.s3FolderName').$s3FileName, file_get_contents($image->getRealPath()));
                    $url = Storage::disk('s3')->url(config('const.s3FolderName').$s3FileName);

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


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
