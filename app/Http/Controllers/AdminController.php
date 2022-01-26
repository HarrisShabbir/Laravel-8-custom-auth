<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::all();
        // dd($users);
        return view('admin.users.manage', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add_user',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    

        // $validation = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:admins',
        //     // 'password' => 'required|min:6',
        // ]); 

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:admins',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $newPassword = Str::random(8);

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($newPassword);
        $user->save();

        if($user){
            $user->assignRole($request->role);
            return redirect()->route('users')->with("success","User is created successfully");
            //Send Credentials email
            //$newPassword
            //$request->email
        }
        else{
            return redirect()->route('users')->with("error","User is not created due to a reason");
        }

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $userRoleName = $user->getRoleNames()[0];
        $roles = Role::all();
        return view('admin.users.edit_user',compact('user','userRoleName','roles'));
        // return view('admin.users.edit_user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:admins,email,'.$request->id,
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $user = Admin::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if($user){
            $user->syncRoles($request->role);
            return redirect()->route('users')->with("success","User is updated successfully");
            //Send Credentials email
            //$newPassword
            //$request->email
        }
        else{
            return redirect()->route('users')->with("error","User is updated due to some reason");
        }
        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Admin::find($id);
        $user->delete();
        return back()->with('warning','User record has been deleted');

        // dd($id);
        // return redirect()->route('users');
    }

    function haspermission($id){
        $user = Admin::find($id);
        if($user){
            $userPermissions = $user->getAllPermissions();
            $permissions = Permission::all();
            return view('admin.users.haspermissions',compact('user','permissions','userPermissions'));            
        }else{
            return back()->with('error','Sorry, Something went Wrong');
        }
    }

    public function haspermissionupdate(Request $request){

        $user = Admin::find($request->user_id);
        $user->syncPermissions();
        foreach ($request->UserPermissionIDs as $UserPermissionID) {
            $user->givePermissionTo($UserPermissionID);
        }
        return redirect()->route('users')->with("success","User Permission updated successfully");
    }

// Profile Functions

public function profile(){
    $user = Admin::find(auth()->user()->id);
    $pwd = User::find(auth()->user()->id);
    return view('admin.profiles.profile',compact('user','pwd'));

}
public function profileupdate(Request $request){
    
    $user_id = Auth::user()->id;
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:admins,email,'.$user_id,
    ]);
    
    if($validator->fails()){
        return back()->withErrors($validator->errors());
    }

    $user = Admin::find($user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    if($user){
    return redirect()->route('profile')->with('success','User profile is updated successfully');
        // $user->syncRoles($request->role);
        //Send Credentials email
        //$newPassword
        //$request->email
    }
    else{
        return redirect()->route('profile')->with('error','User profile is not updated due to a reason');
    }
}

    public function updatepassword(Request $request){
    
        $user_id = Auth()->user()->id;
    
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors()->first());
        }

        $user = Admin::find($user_id);
        
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error','Your current Password is invalid');
        }
        
        $updated = $user->update([
            'password'=> Hash::make($request->new_password)
        ]);
        
        if($updated){
            return redirect()->route('profile')->with('success','User Password has been updated');
        }else{
            return back()->with('error','Password not updated due to some error. Please try again');
        }
    }


}
