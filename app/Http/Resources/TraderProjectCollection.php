<?php

namespace App\Http\Resources;

use App\Models\Estimate;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TraderProjectCollection extends BaseCollection
{
    public function toArray($request = null)
    {
        $this->collection->transform(function ($project) use ($request) {
            $projectArray = is_array($project) ? $project : $project->toArray();
            $projectArray['trader_project_status'] = tradesperson_project_status($project->id);
            $projectArray['project_completed_percent'] = null;

            $estimate = Estimate::where([
                'project_id' => $project->id,
                'tradesperson_id' => request()->user()->id,
                'project_awarded' => 1
            ])->first();
            if ($estimate) {
                $total_tasks = $estimate->tasks->count();
                $completed_tasks = $estimate->tasks->where('status', 'completed')->count();
                $projectArray['project_completed_percent'] = ($completed_tasks / $total_tasks) * 100;
            }

            return $projectArray;
        });

        return $this->collection;
    }
}
