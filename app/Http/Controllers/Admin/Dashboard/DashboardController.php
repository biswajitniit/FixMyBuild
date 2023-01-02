<?php
namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
class DashboardController extends Controller
{

    public function __construct()
    {
		$this->middleware('auth:admin');
    }

    /**
     * Show the Admin Dashboard Page.
     *
     * @return \Illuminate\Http\Response
     */
	public function dashboard(Request $request){

		return view("admin.dashboard.index");

	}




}
