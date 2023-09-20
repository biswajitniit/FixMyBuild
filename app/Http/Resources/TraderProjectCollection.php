<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TraderProjectCollection extends BaseCollection
{
    public function toArray($request = null)
    {
        $this->collection->transform(function ($project) {
            $projectArray = is_array($project) ? $project : $project->toArray();
            $projectArray['trader_project_status'] = tradesperson_project_status($project->id);

            return $projectArray;
        });

        return $this->collection;
    }
}
