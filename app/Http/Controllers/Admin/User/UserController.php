<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;


class UserController extends Controller
{

    public function users(){
        return view('admin.user.user-list');
    }
    public function ajax_users_list_datatable(Request $request){

        $query=User::get();
        $totalData =count($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        return DataTables::of($query)
        ->addColumn('name', function ($query) {
            return $query->name;
        })
        ->addColumn('email', function ($query) {
            return $query->email;
        })
        ->addColumn('phone', function ($query) {
            return $query->email;
        })
        ->addColumn('customer_or_tradesperson', function ($query) {
            if($query->customer_or_tradesperson=='Customer'){
                $customer_or_tradesperson='Customer';
            }else{
                $customer_or_tradesperson='Tradesperson';
            }
            return $customer_or_tradesperson;
        })
        ->addColumn('status', function ($query) {
            if($query->status==1){
                $mstatus='Active';
            }else{
                $mstatus='InActive';
            }
            return $mstatus;
        })
        ->addColumn('action', function ($query) {
            return $query->id;
        })->rawColumns(['action'])
        ->make('true');


    }

}
