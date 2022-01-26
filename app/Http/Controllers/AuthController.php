<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    function registration(){
        return view('admin/registration');
    }
    function postregistration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $createUser = $this->create($data);

if($createUser){

}
$token = Str::random(64);

UserVerify::create([
      'user_id' => $createUser->id,
      'token' => $token
    ]);

    Mail::send('admin/emails/emailVerificationEmail', ['token' => $token], function($message) use($request){
        $message->to($request->email);
        $message->subject('Email Verification Mail');
    });
    return redirect("admin/dashboard")->with('success','Great! You have Successfully loggedin');
    }

   function index(){
//        if(auth()->user()){
//         return redirect("admin.dashboard");
//        }
       return view('admin/login');
   }

//    public function postLogin(Request $request)
//    {
//        $request->validate([
//            'email' => 'required',
//            'password' => 'required',
//        ]);
//        $credentials = $request->only('email', 'password');
//        if (Auth::attempt($credentials)) {
//            return redirect('admin.dashboard')
//                        ->withSuccess('You have Successfully loggedin');
//        }
//        return redirect("admin.login")->withSuccess('Oppes! You have entered invalid credentials');
//    }
   public function postLogin(Request $request)
   {

       $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);
       $credentials = $request->only('email', 'password');
       if (!Auth::attempt($credentials)) {
           return back()->with('message','Invalid Email Password.');
        }
        return redirect('admin/dashboard')->with(['success' => 'You have successfully logged in', 'title' => 'Welcome '.auth()->user()->name.'!']);
   }
   public function dashboard()
   {
       if(Auth::check()){

           $data['moduleName'] = 'Dashboard'; //[["name" => "Group", "link" => "groups"],["name" => "Group Detail"]];
           $data['breadcrumbs'] = [['name' => 'Dashboard', "link" => "dashboard"]]; //[["name" => "Group", "link" => "groups"],["name" => "Group Detail"]];

           $breadcrumbs = ['Dashboard', 'breadcrumbs' => ['name' => 'Dashboard', 'link' => 'dashboard']];

           return view('admin/dashboard',compact('data'));
       }
       return redirect("admin/login")->with('message','Opps! You do not have access');
   }
   public function create(array $data)
   {
     return User::create([
       'name' => $data['name'],
       'email' => $data['email'],
       'password' => Hash::make($data['password'])
     ]);
   }

   public function logout() {
       Auth::logout();
       return Redirect('admin/login');
   }

   public function verifyAccount($token)
   {
       $verifyUser = UserVerify::where('token', $token)->first();
       if(!$verifyUser){
                    $message = 'Sorry your email cannot be identified.';
                    return back()->with('message',$message);
                }
       if(!is_null($verifyUser) ){
           $user = $verifyUser->user;

           if(!$user->is_email_verified) {
               $verifyUser->user->is_email_verified = 1;
               $verifyUser->user->save();
               $message = "Your e-mail is verified. You can now login.";
           } else {
               $message = "Your e-mail is already verified. You can now login.";
           }
       }

     return redirect('admin/login')->with('message', $message);
   }





//    public function verifyAccount($token)
//    {

//         $verifyUser = UserVerify::where('token', $token)->first();

//         if(!$verifyUser){
//             $message = 'Sorry your email cannot be identified.';
//             return back()->with('message',$message);
//         }

//         $user = User::find($verifyUser->user_id);
//         if($user->is_email_verified == 1){
//             return back()->with('message',"Already Verfied");
//         }

//         $user->is_email_verified = 1;
//         $user->email_verified_at = Carbon::now();
//         $user->save();

//         $message = "Your e-mail is verified. You can now login.";

//         return redirect()->route('login')->with('message', $message);
//    }



}
