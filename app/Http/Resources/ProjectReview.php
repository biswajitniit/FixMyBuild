<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectReview extends JsonResource
{
    public function toArray($request)
    {
        $result =  parent::toArray($request);
        @$result['user_name'] = User::where('id', $result['user_id'])->value('name') ?? null;

        return $result;
    }
}
