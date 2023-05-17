<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function delete_account(Request $request)
    {

        try {
            $user = User::find(auth()->user()->id);
            $user->account_deletion_reason=$request->account_delete;
            $user->delete_permanently=$request->delete_permanently;
            $user->save();
            $user->delete();

           $html = view('email.email-account-delete')->with('name', $user->name)->render();

                $postdata = array(
                                'From'          => 'support@fixmybuild.com',
                                'To'            =>  $user->email,
                                'Subject'       => 'Fixmybuild Account Deletion',
                                'HtmlBody'      =>  $html,
                                'MessageStream' => 'outbound'
                            );

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.postmarkapp.com/email',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>json_encode($postdata),
                  CURLOPT_HTTPHEADER => array(
                    'X-Postmark-Server-Token: 397dcd71-2e20-4a1d-b1fd-24bac29255dc',
                    'Content-Type: application/json'
                  ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

               $message = "Account delete successfully done";
            return redirect()->route('home');
        } catch (Exception $e) {
            $request->session()->flash('alert-danger', $e->getMessage());
        }
    }
}
