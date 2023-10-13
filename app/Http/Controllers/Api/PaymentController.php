<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function onboard_user(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $account = $stripe->accounts->create(['type' => 'express']);

        $account_links = $stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => 'https://example.com/reauth',
            'return_url' => 'https://example.com/return',
            'type' => 'account_onboarding',
        ]);

        return $this->success(['account_links' => $account_links]);
    }
}
