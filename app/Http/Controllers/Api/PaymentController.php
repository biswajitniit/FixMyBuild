<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Task;
use App\Models\TraderDetail;
use Illuminate\Http\Request;
use App\Models\Transactionhistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PaymentController extends BaseController
{
    public function onboard_user(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $account = $stripe->accounts->create(['type' => 'express']);

        $account_links = $stripe->accountLinks->create([
            'account' => $account->id,
            // 'refresh_url' => 'https://fixmybuild.com/reauth',
            'return_url' => 'https://fixmybuild.com/return?account_id=' . $account['id'],
            'refresh_url' => route('stripe.reauth'),
            'type' => 'account_onboarding',
        ]);

        $trader_detail = TraderDetail::where('user_id', request()->user()->id)->first();
        $trader_detail->stripe_account_id = $account['id'];
        $trader_detail->save();

        return $this->success(['account_links' => $account_links]);
    }


    public function stripe_reauth()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $account = $stripe->accounts->create(['type' => 'express']);

        $account_links = $stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => route('stripe.reauth'),
            'return_url' => 'https://fixmybuild.com/return?account_id=' . $account['id'],

            'type' => 'account_onboarding',
        ]);

        $trader_detail = TraderDetail::where('user_id', request()->user()->id)->first();
        $trader_detail->stripe_account_id = $account['id'];
        $trader_detail->save();

        return redirect()->to($account_links['url']);
    }


    // public function stripe_store_account_id()
    // {
    //     $validator = Validator::make(request()->all(), [
    //         'stripe_account_id' => 'required|string'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     try {
    //         if (!isTrader(request()->user()->customer_or_tradesperson)) {
    //             return $this->error('Forbidden', 403);
    //         }

    //         $trader_detail = TraderDetail::where('user_id', request()->user()->id)->first();
    //         if ($trader_detail) {
    //             $trader_detail->stripe_account_id = request()->stripe_account_id;
    //             $trader_detail->save();
    //         } else {
    //             return $this->error('Trader Detail Not Found');
    //         }

    //         return $this->success("Successfully updated your account with your stripe credentials");
    //     } catch (Exception $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }


    public function milestone_payment(Request $request, int $milestone)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'payment_status' => 'required',
            'payment_transaction_id' => 'required',
            'payment_capture_log' => 'required',
            'totalamount' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $orderid = "FIXMYBUILD" . date('Ymd') . rand();
            $task = Task::where('id', $milestone)->first();

            if (!$task) {
                return $this->error('Task Not Found');
            }

            $data = array(
                'payment_status' => $request['payment_status'],
                'status' => $request['status'],
                'payment_type' => 'card',
                'payment_transaction_id' => $request['payment_transaction_id'],
                'payment_capture_log' => $request['payment_capture_log'],
                'payment_date' => date('Y-m-d H:i:s')
            );


            DB::beginTransaction();
            Task::where('id', $milestone)->update($data);

            // Transaction history save
            $th = new Transactionhistory();
            $th->order_id = $orderid;
            $th->user_id = request()->user()->id;
            $th->task_id = $milestone;
            $th->totalamount = $request['totalamount'];
            $th->payment_status = $request['payment_status'];
            $th->payment_type = 'card';
            $th->payment_transaction_id = $request['payment_transaction_id'];
            $th->payment_capture_log = $request['payment_capture_log'];
            $th->payment_date = date('Y-m-d H:i:s');
            $th->save();

            DB::commit();

            return $this->success('Payment completed successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }

    }
}
