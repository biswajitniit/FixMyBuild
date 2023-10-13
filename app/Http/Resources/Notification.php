<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
{
    public function toArray($request)
    {
        $result =  parent::toArray($request);
        $result['time_created'] = time_diff($this->created_at);

        return $result;
    }
}
