<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
       return view('admin/forgetResetPwd/forgetpasswordl');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){

            return back()->with("message","Please Register First.");

        }
        $token = Str::random(64);

        DB::table('password_resets')->where('email',$request->email)->delete();

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

          $data = [
              'from' => env('MAIL_FROM_ADDRESS'),
              'subject' => "Forget Password Request",
              'token' => $token,
              'Username' => $user->name,
          ];

        Mail::to($request->email)->send(new ForgetPassword($data)); 

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) { 
       return view('admin.forgetResetPwd.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $updatePassword = DB::table('password_resets')->where('token', $request->token)->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $newPassword = Hash::make($request->password);

        $user = User::where('email', $updatePassword->email)
                    ->update(['password' => $newPassword]);

        DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

        return redirect('admin/login')->with('message', 'Your password has been changed!');
    }
}
