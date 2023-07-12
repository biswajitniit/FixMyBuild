<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Exception;
//use Stripe\StripeClient;
//use Stripe\Exception\CardException;
use Stripe;
use App\Models\{Estimate, Task};
use App\Models\Transactionhistory;
use Illuminate\Support\Facades\Auth;
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $orderid= "FIXMYBUILD".date('Ymd').rand();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
                // "address" => [
                //         "line1" => "Virani Chowk",
                //         "postal_code" => "360001",
                //         "city" => "Rajkot",
                //         "state" => "GJ",
                //         "country" => "IN",
                //     ],
                "email" => Auth::user()->email,
                //"name" => "Hardik Savani",
                "source" => $request->stripeToken
             ));

        $charge = Stripe\Charge::create ([
                "amount" => $request->totalamount * 100,
                "currency" => "gbp",
                "customer" => $customer->id,
                "description" => $orderid,
        ]);
        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $data = array(
                'payment_status'           => $charge['status'],
                'status'                   => $charge['status'],
                'payment_type'             => 'card',
                'payment_transaction_id'   => $charge['balance_transaction'],
                'payment_capture_log'      => $charge,
                'payment_date'             => date('Y-m-d H:i:s')
            );
            Task::where('id', $request->taskid)->update($data);

            // Transaction history save
            $th = new Transactionhistory();
            $th->order_id               = $orderid;
            $th->user_id                = Auth::user()->id;
            $th->task_id                = $request->taskid;
            $th->totalamount            = $request->totalamount;
            $th->payment_status         = $charge['status'];
            $th->payment_type           = 'card';
            $th->payment_transaction_id = $charge['balance_transaction'];
            $th->payment_capture_log    = $charge;
            $th->payment_date           = date('Y-m-d H:i:s');
            $th->save();

            $request->session()->flash('success', 'Payment completed.');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
        }

        return redirect()->route('customer.project');
    }
}
