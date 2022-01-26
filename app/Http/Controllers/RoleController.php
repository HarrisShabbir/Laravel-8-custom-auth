<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.manage',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|min:3|max:255',
            'guard_name' => 'required|min:3|max:255'
        ]);

        if($validator->fails()){
            return back()->with("error", $validator->errors()->first());
        }

        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        if($role){
            return redirect()->route('roles')->with("success","Role is created.");
        }else{
            return redirect()->route('roles')->with("error","Role is not created.");
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
        $role = Role::find($id);
        return $role;
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
            'guard_name' => 'required|min:3|max:255',
            // 'email' => 'required|email|unique:admins',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        // $user->password = Hash::make($newPassword);
        $role->save();
        // dd($role);
        if($role){
            return redirect()->route('roles')->with("success","Role is Updated Successfully.");
            // return redirect()->route('roles');
            //Send Credentials email
            //$newPassword
            //$request->email
        }else{
            return redirect()->route('roles')->with("error","Having problem while updated role.");
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
        $role = Role::find($id);
        $role->delete();
        return back()->with('warning','User role has been deleted');
    }

    public function haspermission($id){

        $role = Role::find($id);

        if($role){
            $permissions = Permission::all();
            $rolePermissions = $role->getAllPermissions();

            return view("admin.roles.haspermissions",compact('role','permissions','rolePermissions'));
        }else{
            return back()->with("error","Role not available with this id.");
        }
    }

    public function haspermissionupdate(Request $request){

        $role = Role::find($request->role_id);
        $role->syncPermissions();
        foreach ($request->RolePermissionIds as $RolePermissionID) {
            $role->givePermissionTo($RolePermissionID);
        }
        return redirect()->route('roles')->with("success","Role Permission updated successfully");
    }








}
