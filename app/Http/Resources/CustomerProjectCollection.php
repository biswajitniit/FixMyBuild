<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Estimate;
use App\Models\Task;

class CustomerProjectCollection extends BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        $this->collection->transform(function ($project) use ($request) {
            $projectArray = is_array($project) ? $project : $project->toArray();
            $projectArray['project_completed_percent'] = null;

            $estimate = Estimate::where([
                'project_id' => $project->id,
                'project_awarded' => 1
            ])->first();
            if ($estimate) {
                $total_tasks = Task::where(['estimate_id' => $estimate->id, 'is_initial' => false])->count();
                $completed_tasks = Task::where(['estimate_id' => $estimate->id, 'status' => 'completed', 'is_initial' => false])->count();
                $projectArray['project_completed_percent'] = ($completed_tasks / $total_tasks) * 100;
            }

            return $projectArray;
        });

        return $this->collection;
    }
}
