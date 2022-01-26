<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facts = Fact::all();
        return view('admin.facts.manage',compact('facts'));
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
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return back()->with("error", $validator->errors()->first());
        }

        $fact = new Fact();
        $fact->title = $request->title;
        $fact->content = $request->content;
        $fact->save();
        if($fact){
            return redirect()->route('facts')->with("success","Fact is created.");
        }else{
            return redirect()->route('facts')->with("error","Fact is not created.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function show(Fact $fact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fact = Fact::find($id);
        return $fact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            // 'email' => 'required|email|unique:admins',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $fact = Fact::find($request->id);
        $fact->title = $request->title;
        $fact->content = $request->content;
        // $user->password = Hash::make($newPassword);
        $fact->save();
        // dd($role);
        if($fact){
            return redirect()->route('facts')->with("success","Fact is Updated Successfully.");
            // return redirect()->route('roles');
            //Send Credentials email
            //$newPassword
            //$request->email
        }else{
            return redirect()->route('facts')->with("error","Having problem while updated fact.");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fact = Fact::find($id);
        $fact->delete();
        return back()->with('success','Fact has been deleted');
    }
}
