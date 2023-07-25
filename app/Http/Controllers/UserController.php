<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    UserVerify,
    Notification
};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{

    public function registration() {
        return view('registration');
    }

    public function save_user(Request $request){
        $this->validate($request, [
          'name'                          => 'required',
          'email'                         => 'required|string|email|max:191|unique:users,email,NULL,id,deleted_at,NULL',
          'phone'                         => 'required',
          'password'                      => 'required|min:6|confirmed',
          'password_confirmation'         => 'required|min:6',
          'customer_or_tradesperson'      => 'required',
        ],[
          'name.required' => 'Please enter your name',
          'email.required' => 'Please enter your email',
          'phone.required' => 'Please enter your phone',
          'password.required' => 'Please enter your password',
          'password_confirmation.required' => 'Please enter your confirm password',
          'customer_or_tradesperson.required' => 'Please choose whether you are a Customer or a Tradeperson',
        ]);

        $user = new User();
        $user->name                      = $request['name'];
        $user->email                     = $request['email'];
        $user->phone                     = $request['full_phone'];
        $user->password                  = Hash::make($request['password']);
        $user->customer_or_tradesperson  = $request['customer_or_tradesperson'];
        $user->steps_completed           = 1;
        $user->verified                  = 1;
        $user->locked                    = 1;
        $user->terms_of_service          = $request['terms_of_service'];
        $user->status                    = 'Active';
        $user->save();
        $settings = [];

        if (Str::lower($request->customer_or_tradesperson) == 'customer') {
            $settings = [
                'reviewed'                  => config('const.customer_notification_reviewed'),
                'paused'                    => config('const.customer_notification_paused'),
                'project_milestone_complete'=> config('const.customer_notification_project_milestone_complete'),
                'project_complete'          => config('const.customer_notification_project_complete'),
                'project_new_message'       => config('const.customer_notification_project_new_message'),
            ];
        } else {
            $settings = [
                // Receive these notifications as a Customer
                'reviewed'                  => config('const.trader_notification_reviewed'),
                'paused'                    => config('const.trader_notification_paused'),
                'project_milestone_complete'=> config('const.trader_notification_project_milestone_complete'),
                'project_complete'          => config('const.trader_notification_project_complete'),
                'project_new_message'       => config('const.trader_notification_project_new_message'),

                // Receive these notifications as a Tradesperson
                'builder_amendment'         => config('const.trader_notification_builder_amendment'),
                'noti_new_quotes'           => config('const.trader_notification_new_estimates'),
                'noti_quote_accepted'       => config('const.trader_notification_estimate_accepted'),
                'noti_project_stopped'      => config('const.trader_notification_project_stopped'),
                'noti_quote_rejected'       => config('const.trader_notification_estimate_rejected'),
                'noti_project_cancelled'    => config('const.trader_notification_project_cancelled'),
                'noti_share_contact_info'   => config('const.trader_notification_share_contact_info'),
                'noti_new_message'          => config('const.trader_notification_trader_new_message'),
            ];
        }

        Notification::create([
            'user_id' => $user->id,
            'settings' => $settings
        ]);

        $token = Str::random(64);

        UserVerify::create([
          'user_id' => $user->id,
          'token' => $token
        ]);

        $html = view('email.email-verification-mail')->with('token', $token)->render();

        $emaildata = array(
          'From'          => 'support@fixmybuild.com',
          'To'            => $request['email'],
          'Subject'       => 'Verify Email',
          'HtmlBody'      => $html,
          'MessageStream' => 'outbound'
        );

        $email_sent = send_email($emaildata);

        // return redirect()->back()->with('message', 'Thanks for your registration, please check your inbox! for email verification .');
        if (\Str::lower($user->customer_or_tradesperson) == "customer")
            return redirect()->route('user.registration')->with('message', 'Please check your inbox for our email verification link.');

        // Log in the tradesperson
        Auth::login($user);
        return redirect()->route('tradepersion.compregistration');
    }


    public function verifyAccount($token) {
      $verifyUser = UserVerify::where('token', $token)->first();
      $message = 'Sorry your email cannot be identified.';
      if(!is_null($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->is_email_verified) {
          $verifyUser->user->is_email_verified = 1;
          $verifyUser->user->save();

          $html = view('email.email-verify-account')->with('name', $user->name)->render();

          $emaildata = array(
            'From'          => 'support@fixmybuild.com',
            'To'            => $user->email,
            'Subject'       => 'Fixmybuild',
            'HtmlBody'      =>  $html,
            'MessageStream' => 'outbound'
          );

          $email_sent = send_email($emaildata);

          $message = "Your e-mail is verified. You can now login.";
        } else {
          $message = "Your e-mail is already verified. You can now login.";
        }
      }
      return redirect()->route('login')->with('message', $message);
    }

    public function delete_account(Request $request) {
      try {
        $user = User::find(auth()->user()->id);
        $user->account_deletion_reason=$request->account_delete;
        $user->delete_permanently=$request->delete_permanently;
        $user->save();
        $user->delete();

        $html = view('email.email-account-delete')->with('user', $user)->render();

        $emaildata = array(
          'From'          => 'support@fixmybuild.com',
          'To'            =>  $user->email,
          'Subject'       => 'Fixmybuild Account Deletion',
          'HtmlBody'      =>  $html,
          'MessageStream' => 'outbound'
        );

        $email_sent = send_email($emaildata);

        return redirect()->route('home');
      } catch (Exception $e) {
        $request->session()->flash('alert-danger', $e->getMessage());
        echo $e->getMessage();
      }
    }

    public function resend_verification_email(Request $request, User $user) {
      try{
        $token = Str::random(64);
        $data = UserVerify::where('user_id', '=', Auth::user()->id)->update(array('token' => $token,'updated_at'=>now()));
        $html = view('email.email-verification-mail')->with('token', $token)->render();
        $emaildata = array(
          'From'          => 'support@fixmybuild.com',
          'To'            => Auth::user()->email,
          'Subject'       => 'Verify Email',
          'HtmlBody'      => $html,
          'MessageStream' => 'outbound'
        );

        $email_sent = send_email($emaildata);

        return 'Please check your inbox for email verification .';
      } catch (Exception $e) {
        return "error";
      }
    }

    //delete account for tradeperson
    public function delete_account_tradeperson(Request $request) {
        try {
            $user = User::find(auth()->user()->id);
            $user->account_deletion_reason = $request->account_delete;
            $user->delete_permanently = $request->delete_permanently;
            $user->save();
            $user->delete();

            $html = view('email.email-account-delete')->with('user', $user)->render();

            $emaildata = array(
                'From'          => 'support@fixmybuild.com',
                'To'            =>  $user->email,
                'Subject'       => 'Fixmybuild Account Deletion',
                'HtmlBody'      =>  $html,
                'MessageStream' => 'outbound'
            );

            $email_sent = send_email($emaildata);

            return redirect()->route('home');
        } catch (\Exception $e) {
            $request->session()->flash('alert-danger', $e->getMessage());
            echo $e->getMessage();
        }
    }
}
