<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $model = User::findorfail($id);
        return view('users.profile',compact('model'));
    }
    public function update(Request $request,$id)
    {
        $rules = [
            'name' =>'required',
            'email' => Rule::unique('users')->ignore($id),
            'password' =>'required|confirmed|min:8',
            'password_confirmation'=>'required',
        ];
        $this->validate($request,$rules);
        $request->merge(['password'=>bcrypt($request->password)]);
        $record = User::findorfail($id);
        $record->update($request->all());
        flash()->success('Updated');
        return redirect(route('home'));
    }
}
