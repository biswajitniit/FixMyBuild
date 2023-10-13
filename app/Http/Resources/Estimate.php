<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class Estimate extends JsonResource
{
    public function toArray($request)
    {
        $tasks = DB::table('tasks')
            ->where('estimate_id', $this->id)
            ->select('price', 'contingency')
            ->get();

        foreach ($tasks as $task) {
            $task->contingency_amount = ($task->contingency / 100) * $task->price;
            $task->price_including_contingency = $task->contingency_amount + $task->price;
        }

        $price = $tasks->sum('price');
        $price_including_vat = $this->apply_vat ? $price + config('const.vat_charge'): $price;
        $price_including_contingency = $tasks->sum('price_including_contingency');
        $price_including_vat_contingency = $this->apply_vat ? $price_including_contingency + config('const.vat_charge') : $price_including_contingency;

        $estimate = parent::toArray($request);
        $estimate['price'] = $price;
        $estimate['price_including_vat'] = $price_including_vat;
        $estimate['price_including_contingency'] = $price_including_contingency;
        $estimate['price_including_vat_contingency'] = $price_including_vat_contingency;

        return $estimate;
    }
}
