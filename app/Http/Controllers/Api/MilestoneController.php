<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Task;
use App\Models\Estimate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\ProjectStatusChangeLog;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class MilestoneController extends BaseController
{
    public function index(Request $request, int $project)
    {
        try {
            $estimate = Estimate::where(['project_id' => $project, 'project_awarded' => 1])->first();

            if (!$estimate) {
                return $this->error('No estimate found for this project', 404);
            }

            if ($estimate->tradesperson_id == $request->user()->id || $estimate->project->user_id == $request->user()->id) {
                $milestones = Task::where(['estimate_id' => $estimate->id])->get();

                return $milestones;
            } else {
                return $this->error('You are not authorized to view this project', 403);
            }
        } catch (Exception $e) {
            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function show(Request $request, int $milestone) {
        try {
            $milestone = Task::find($milestone);

            if (!$milestone) {
                return $this->error('Milestone not found', 404);
            }

            if ($milestone->estimate->tradesperson_id == $request->user()->id || $milestone->estimate->project->user_id == $request->user()->id) {
                return $milestone;
            }

            return $this->error('You are not authorized to view this task', 403);
        } catch (Exception $e) {
            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, int $milestone) {
        $validator = Validator::make($request->all(), [
            'contingency' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->error(['errors' => $validator->errors()], 422);
        }

        try {
            $task = Task::where('id', $milestone)->first();

            if (!$task) {
                return $this->error('Milestone not found', 404);
            }

            if ($task->estimate->tradesperson_id != $request->user()->id) {
                return $this->error('You are not authorized to update this milestone', 403);
            }

            if ($request->contingency > $task->max_contingency) {
                return $this->error('Contingency cannot be greater than max contingency.', 400);
            }

            $task->contingency = $request->contingency;
            $task->save();

            return $this->success('Milestone updated successfully');
        } catch (Exception $e) {
            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function milestone_wizard(Request $request, int $project)
    {
        return ProjectStatusChangeLog::where('project_id', $project)->get();
    }


    public function milestone_completed(Request $request, $milestone)
    {
        try {
            DB::beginTransaction();
            $task = Task::findOrFail($milestone);
            $task->status = 'completed';
            $task->save();

            milestone_completion_notification($milestone);

            $unpaid_tasks = Task::where(['estimate_id' => $task->estimate_id, 'status' => null])->count();
            if ($unpaid_tasks == 0) {
                Project::where('id', $task->estimate->project_id)->update(['status' => config('const.project_status.AWAITING_YOUR_REVIEW')]);
            }
            DB::commit();

            return $this->success("Milestone completed successfully");
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }
}
