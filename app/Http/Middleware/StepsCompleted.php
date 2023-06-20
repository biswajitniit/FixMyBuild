<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StepsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = auth()->user();

        // if($user->steps_completed == 1) {
        //     return redirect()->route('tradepersion.compregistration');
        // } elseif ($user->steps_completed == 2) {
        //     return redirect()->route('tradepersion.bankregistration')->with('bank_reg_completed', false);
        // } elseif ($user->steps_completed == 3 && $user->verified == 0) {
        //     return redirect()->route('tradepersion.dashboard')->with('bank_reg_completed', true)->with('message', 'Your request has been successfully received');
        // }
        return $next($request);
    }
}
