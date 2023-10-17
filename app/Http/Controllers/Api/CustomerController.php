<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends BaseController
{
    public function email_notifications(Request $request) {
        $validator = Validator::make($request->all(), [
            "reviewed" => 'required|boolean',
            "paused" => 'required|boolean',
            "project_milestone_complete" => 'required|boolean',
            "project_complete" => 'required|boolean',
            "project_new_message" => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return $this->error(['errors' => $validator->errors()], 422);
        }

        try {
            if (!isCustomer($request->user()->customer_or_tradesperson)) {
                return $this->error(['message' => 'You are not a customer'], 400);
            }

            $settings = [
                "reviewed" => $request->reviewed,
                "paused" => $request->paused,
                "project_milestone_complete" => $request->project_milestone_complete,
                "project_complete" => $request->project_complete,
                "project_new_message" => $request->project_new_message
            ];

            Notification::updateOrCreate(['user_id' => $request->user()->id], ['settings' => $settings]);

            return $this->success('Settings updated successfully.');
        } catch (Exception $e) {
            return $this->error(['errors' => $e->getMessage()], 500);
        }
    }
}
