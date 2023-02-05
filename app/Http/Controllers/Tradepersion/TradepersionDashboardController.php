<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkType;
use App\Models\AreaCover;
use App\Models\SubWorkType;
use App\Models\SubAreaCover;

class TradepersionDashboardController extends Controller
{
    public function registrationsteptwo()
    {
        $works = WorkType::where('status', 1)->get();
        $areas = AreaCover::where('status', 1)->get();
        return view('tradepersion.registrationtwo', compact('works', 'areas'));
    }
}
