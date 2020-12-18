<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::paginate(10);
        return view('users.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' =>'required',
            'email' =>'required|unique:users',
            'password' =>'required|confirmed|min:8',
            'password_confirmation'=>'required',
            'roles_list' => 'required'
        ];
        $this->validate($request,$rules);
        $record = User::create($request->except('roles_list'));
        $record->roles()->attach($request->input('roles_list'));
        flash()->success('Added');
        return redirect(route('users.index'));
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
        $model = User::findorfail($id);
        return view('users.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' =>'required',
            'email' => Rule::unique('users')->ignore($id),
            'password' =>'required|confirmed|min:8',
            'password_confirmation'=>'required',
            'roles_list' => 'required'
        ];
        $this->validate($request,$rules);
        $user = User::findOrFail($id);
        $user->roles()->sync($request->input('roles_list'));
        $request->merge(['password'=>bcrypt($request->password)]);
        $record = User::findorfail($id);
        $record->update($request->all());
        flash()->success('Updated');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findorfail($id);
        $record->delete();
        flash()->error("deleted");
        return redirect(route('users.index'));
    }
}
