<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Traderareas;
use App\Models\TraderDetail;
use App\Models\Traderworks;
use App\Models\TradespersonFile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stringable;

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
            return $query->status;
        })
        ->addColumn('action', function ($query) {
            return '<a href=" '. route('admin.user-detail', Hashids_encode($query->id) ) .' " title="Edit User"><i class="mdi mdi-table-edit"></i></a>';
        })->rawColumns(['action'])
        ->make('true');


    }

    public function user_detail_page(Request $request, $id)
    {
        $user = User::where('id', Hashids_decode($id))->firstOrFail();

        // if (strtolower($user->customer_or_tradesperson) == 'customer')
        //     return view('admin.user.user-detail', compact('user'));

        $trader_detail = TraderDetail::where('user_id', Hashids_decode($id))->first();
        $trader_files  = TradespersonFile::where('tradesperson_id', Hashids_decode($id))->orderBy('file_related_to', 'asc')->get()->groupBy('file_related_to');
        $trader_areas  = Traderareas::where('user_id', Hashids_decode($id))->with('subareas')->get();
        // $trader_areas  = Traderareas::where('user_id', Hashids_decode($id))
        //                             ->with('subareas')
        //                             ->get()
        //                             ->groupBy(function($query){
        //                                 return $query->subareas->area_type_id;
        //                             });
        $trader_works  = Traderworks::where('user_id', Hashids_decode($id))->with('buildersubcategory')->get();

        return view('admin.user.user-detail', compact('user', 'trader_detail', 'trader_files', 'trader_areas', 'trader_works'));
    }

    public function verify_account(Request $request, $id) {
        $trader_detail = TraderDetail::where('user_id', Hashids_decode($id))->update(
            ['approval_status' => $request->input('action')]
        );
        $action = $request->input('action');

        return redirect()->route('admin.user-detail', $id);
    }

    public function delete_account(Request $request)
    {

        try {
            $user = User::find(auth()->user()->id);
            $user->account_deletion_reason=$request->account_delete;
            $user->delete_permanently=$request->delete_permanently;
            $user->save();
            $user->delete();

           $html = view('email.email-account-delete')->with('user', $user)->render();

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

               return redirect()->route('home');
        } catch (Exception $e) {
            $request->session()->flash('alert-danger', $e->getMessage());

            echo $e->getMessage();
        }
    }

    public function verify_mail(Request $request, User $user)
    {
        try{
            $token = Str::random(64);
            $data = DB::table('users_verify')->where('user_id', '=', Auth::user()->id)->update(array('token' => $token,'updated_at'=>now()));
            $html = view('email.email-verification-mail')->with('token', $token)->render();
                $postdata = array(
                        'From'          => 'support@fixmybuild.com',
                        'To'            => Auth::user()->email,
                        'Subject'       => 'Verify Email',
                        'HtmlBody'      => $html,
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
                return 'Please check your inbox for email verification .';
        } catch (Exception $e) {
            return "error";
        }
    }
}
