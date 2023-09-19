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
                $projects = Project::where('reviewer_status', 'approved')
                    ->where(function ($query) use ($request) {
                        $query->whereIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review'])
                            ->whereIn('id', Estimate::where(['tradesperson_id' => $request->user()->id, 'project_awarded' => 1])
                                ->pluck('project_id')
                                ->toArray()
                            );
                    })
                    ->orWhere(function($query) use ($request) {
                        $query->where('status','project_started')
                            ->whereIn('id', Estimate::where(['tradesperson_id' => $request->user()->id, 'project_awarded' => 1])
                                ->where('project_awarded', 0)
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
                $projects = recommended_projects($trader_areas, $trader_works)->paginate($request->limit ?? 10);
            } else if ($request->filled('ongoing') && $request->ongoing == 1) {
                $projects = Project::where(function ($query) use ($request) {
                    $query->where(function($q) use($request) {
                        $q->whereIn('id', Estimate::where('tradesperson_id', $request->user()->id)->where(function($sub_q) {
                            $sub_q->where('estimates.status', '<>', 'trader_rejected')->orWhereNull('estimates.status');
                        })->pluck('project_id'))
                        ->where('reviewer_status', 'approved')
                        ->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review']);
                    })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('reviewer_status', 'approved')
                            ->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review'])
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
                ->paginate($request->limit ?? 10);
            } else {
                $projects = recommended_projects($trader_areas, $trader_works)
                    ->orWhere(function ($query) use ($request) {
                        $query->where(function($q) use($request) {
                            $q->whereIn('id', Estimate::where('tradesperson_id', $request->user()->id)->where(function($sub_q) {
                                $sub_q->where('estimates.status', '<>', 'trader_rejected')->orWhereNull('estimates.status');
                            })->pluck('project_id'))
                            ->where('reviewer_status', 'approved')
                            ->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review']);
                        })
                        ->orWhere(function ($q) use ($request) {
                            $q->where('reviewer_status', 'approved')
                                ->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review'])
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
                    ->paginate($request->limit ?? 10);
            }

            return $this->success((new TraderProjectCollection($projects))->additional($projects));
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
