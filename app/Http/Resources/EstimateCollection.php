<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EstimateCollection extends BaseCollection
{
    public function toArray($request = null)
    {
        return parent::toArray($request);
    }
}
