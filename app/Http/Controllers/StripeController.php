<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Exception;
//use Stripe\StripeClient;
//use Stripe\Exception\CardException;
use Stripe;
use App\Models\{Estimate, Task};
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
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
                // "address" => [
                //         "line1" => "Virani Chowk",
                //         "postal_code" => "360001",
                //         "city" => "Rajkot",
                //         "state" => "GJ",
                //         "country" => "IN",
                //     ],
                "email" => "biswajitmaityniit@gmail.com",
                //"name" => "Hardik Savani",
                "source" => $request->stripeToken
             ));

        $charge = Stripe\Charge::create ([
                "amount" => $request->totalamount * 100,
                "currency" => "gbp",
                "customer" => $customer->id,
                "description" => rand(1000,2),
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
            $request->session()->flash('success', 'Payment completed.');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
        }

        return back();
    }
}
