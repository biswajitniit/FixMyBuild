<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Project;
use App\Models\Estimate;
use App\Models\Traderareas;
use App\Models\Traderworks;
use Illuminate\Http\Request;
use App\Http\Requests\TraderProjectRequest;
use App\Http\Resources\TraderProjectCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TradespersonProjectController extends BaseController
{
    public function index(TraderProjectRequest $request)
    {
        try {
            if (request()->user()->customer_or_tradesperson == config('const.user_types.CUSTOMER')) {
                return $this->error("Forbidden!", 403);
            }

            $trader_areas = Traderareas::where('user_id', $request->user()->id)->get();
            $trader_works = Traderworks::where('user_id', $request->user()->id)->get();

            $projects = null;

            if ($request->filled('history') && $request->history == 1) {
                // $projects = Project::where('reviewer_status', 'approved')
                //     ->where(function ($query) use ($request) {
                //         $query->whereIn('status', config('const.trader_project_history_statuses'))
                //             ->whereIn('id', Estimate::where(['tradesperson_id' => $request->user()->id, 'project_awarded' => 1])
                //                 ->pluck('project_id')
                //                 ->toArray()
                //             );
                //     })
                    // // ->orWhere(function($query) use ($request) {
                    // //     // Cancelled projects for which the trader has submitted an estimate and none of the estimate has been accepted by customer
                    // //     $query->where('status', config('const.trader_project_history_statuses.PROJECT_CANCELLED'))
                    // //         ->whereDoesntHave('estimates', function ($query) {
                    // //             $query->where('project_awarded', 1);
                    // //         })
                    // //         ->whereIn('id', Estimate::where('tradesperson_id', $request->user()->id)
                    // //             ->pluck('project_id')
                    // //             ->toArray()
                    // //         );
                    // // })
                    // ->orWhere(function($query) use ($request) {
                    //     $query->where('status', 'project_started')
                    //         ->whereIn('id', Estimate::where(['tradesperson_id' => $request->user()->id, 'project_awarded' => 1])
                    //             ->where('project_awarded', 0)
                    //             ->pluck('project_id')
                    //             ->toArray()
                    //         );
                    // })
                $projects = Project::where('reviewer_status', 'approved')
                    ->where(function ($query) use ($request) {
                        $query->whereIn('status', config('const.trader_project_history_statuses'))
                            ->whereIn('id', Estimate::where(['tradesperson_id' => $request->user()->id, 'project_awarded' => 1])
                                ->pluck('project_id')
                                ->toArray()
                            );
                    })
                    ->orWhere(function ($query) use ($request) {
                        // Get the projects for which the estimates has been rejected by the customer or the customer has cancelled the project
                        $query->whereIn('id', Estimate::where(['tradesperson_id' => $request->user()->id, 'project_awarded' => 0])
                            ->pluck('project_id')
                            ->toArray()
                        );
                    })
                    ->when($request->filled('order_by'), function ($query) use ($request) {
                        $query->orderBy($request->order_by, $request->order_by_type ?? 'desc');
                    }, function ($query) {
                        $query->orderBy('created_at', 'desc');
                    })
                    ->paginate($request->limit ?? 10);
            } else if ($request->filled('new') && $request->new == 1) {
                $projects = recommended_projects($trader_areas, $trader_works)
                    ->orWhere(function($q) use($request) {
                        $q->whereIn('id', Estimate::where('tradesperson_id', $request->user()->id)->where(function($sub_q) {
                            $sub_q->where('estimates.status', '<>', 'trader_rejected')->orWhereNull('estimates.status');
                        })->pluck('project_id'))
                        ->where('reviewer_status', 'approved')
                        ->whereNotIn('status', config('const.trader_project_history_statuses'));
                    })
                    ->when($request->filled('order_by'), function ($query) use ($request) {
                        $query->orderBy($request->order_by, $request->order_by_type ?? 'desc');
                    }, function ($query) {
                        $query->orderBy('created_at', 'desc');
                    })
                    ->paginate($request->limit ?? 10);
            } else if ($request->filled('ongoing') && $request->ongoing == 1) {
                $projects = Project::where(function ($query) use ($request) {
                    $query->where('reviewer_status', 'approved')
                        ->whereNotIn('status', config('const.trader_project_history_statuses'))
                        ->whereIn('projects.id', Estimate::where([
                            'tradesperson_id'=> $request->user()->id,
                            'project_awarded'=> 1,
                            'status'=>'awarded'
                        ])->pluck('project_id'));
                })
                ->when($request->filled('order_by'), function ($query) use ($request) {
                    $query->orderBy('projects.'.$request->order_by, $request->order_by_type ?? 'desc');
                }, function ($query) {
                    $query->orderBy('projects.created_at', 'desc');
                })
                ->paginate($request->limit ?? 10);
            } else {
                $projects = recommended_projects($trader_areas, $trader_works)
                    ->orWhere(function ($query) use ($request) {
                        $query->where(function($q) use($request) {
                            $q->whereIn('id', Estimate::where('tradesperson_id', $request->user()->id)->where(function($sub_q) {
                                $sub_q->where('estimates.status', '<>', 'trader_rejected')->orWhereNull('estimates.status');
                            })->pluck('project_id'))
                            ->where('reviewer_status', 'approved')
                            ->whereNotIn('status', config('const.trader_project_history_statuses'));
                        })
                        ->orWhere(function ($q) use ($request) {
                            $q->where('reviewer_status', 'approved')
                                ->whereNotIn('status', config('const.trader_project_history_statuses'))
                                ->whereIn('projects.id', Estimate::where([
                                    'tradesperson_id'=> $request->user()->id,
                                    'project_awarded'=> 1,
                                    'status'=>'awarded'
                                ])->pluck('project_id'));
                        });
                    })
                    ->when($request->filled('order_by'), function ($query) use ($request) {
                        $query->orderBy('projects.'.$request->order_by, $request->order_by_type ?? 'desc');
                    }, function ($query) {
                        $query->orderBy('projects.created_at', 'desc');
                    })
                    ->paginate($request->limit ?? Project::count());
            }

            return $this->success((new TraderProjectCollection($projects))->additional($projects));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    public function recommendation(Request $request, $project) {
        try {
            $trader_areas = Traderareas::where(['user_id' => $request->user()->id])->get();
            $trader_works = Traderworks::where('user_id', $request->user()->id)->get();

            $other_open_projects = recommended_projects($trader_areas, $trader_works)
                ->where('id', '<>', $project)
                ->whereDoesntHave('estimates', function ($query) {
                    $query->where('tradesperson_id', request()->user()->id);
                })
                ->limit(5)
                ->get();

            return $this->success($other_open_projects);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    public function reject(Request $request, $project_id) {

        $validator = Validator::make($request->all(), [
            'reason' => ['required', 'string', Rule::in(['do_not_undertake_the_work', 'not_available_for_work', "do_not_cover_the_customer's_location", "other_reasons"])],
            'more_details' => ['nullable', 'required_if:reason,other_reasons', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->error(['errors' => $validator->errors()], 422);
        }

        try {
            $project = Project::find($project_id);

            if (!$project) {
                return $this->error("Project not found!", 404);
            }

            $estimate = new Estimate();
            $estimate->project_id = $project_id;
            $estimate->tradesperson_id = $request->user()->id;
            $estimate->project_awarded = 0;
            $estimate->status = 'trader_rejected';
            $estimate->describe_mode = $request->reason;
            $estimate->more_info = $request->more_details;
            $estimate->covers_customers_all_needs = 0;
            $estimate->payment_required_upfront = 0;
            $estimate->save();

            return $this->success('Project rejected successfully!');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    public function store(Request $request)
    {
        //
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
