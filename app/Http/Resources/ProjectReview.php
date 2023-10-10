<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectReview extends JsonResource
{
    public function toArray($request)
    {
        $result =  parent::toArray($request);
        @$result['user_name'] = User::where('id', $result['user_id'])->value('name') ?? null;
        @$result['project_county'] = @$this->project->county;
        @$result['project_town'] = @$this->project->town;
        @$result['project_postcode'] = @$this->project->postcode;

        return $result;
    }
}
