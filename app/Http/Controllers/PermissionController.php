<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.manage',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:admins',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        // $newPassword = Str::random(8);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        // $user->password = Hash::make($newPassword);
        $permission->save();
        // dd($role);
        if($permission){
            return redirect()->route('permissions')->with("success","Permission is created Successfully.");
            //Send Credentials email
            //$newPassword
            //$request->email
        }
        else{
            return redirect()->route('permissions')->with("error","Sorry, Permission is not created due to a reason.");
        }
            
        
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
        $permission = Permission::find($id);
        return $permission;
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
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:admins',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        // $user->password = Hash::make($newPassword);
        $permission->save();
        // dd($role);
        if($permission){
            return redirect()->route('permissions')->with("success","Permission is updated Successfully.");
            //Send Credentials email
            //$newPassword
            //$request->email
        }else{
            return redirect()->route('permissions')->with("success","Permission is not created due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Permission::find($id);
        $role->delete();
        return back()->with('warning','User permission has been deleted');
    }
}
