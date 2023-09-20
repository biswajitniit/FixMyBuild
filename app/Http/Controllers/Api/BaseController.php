<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function success($message, int $status = 200)
    {
        if (is_string($message) && $message != '') {
            $successResponse = ['message' => $message];
        }

        if (is_array($message)) {
            $successResponse = $message;
        }

        if (is_object($message)) {
            $successResponse = $message;
        }

        return response()->json($successResponse, $status);
    }


    public function error($error = null, int $status = 500)
    {
        $errorResponse = ['error' => config('const.ERROR_MESSAGE')];

        if (is_string($error) && $error != '') {
            $errorResponse['error'] = $error;
        }

        if (is_array($error)) {
            $errorResponse = $error;
        }

        return response()->json($errorResponse, $status);
    }
}
