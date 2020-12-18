<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = District::paginate(20);
        return view('districts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('districts.create');
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
            'name'=>'required',
            'city_id' => 'required'
        ];
        $message = [
            'name.required' => 'Name is Required'
        ];
        $this->validate($request , $rules , $message);
        District::create($request->all());
        flash()->success('Added');
        return redirect(route('districts.index'));
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
        $model = District::findOrFail($id);
        return view('districts.edit',compact('model'));
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
            'name'=>'required',
            'city_id' => 'required'
        ];
        $message = [
            'name.required' => 'Name is Required'
        ];
        $this->validate($request , $rules , $message);
        $city = District::findOrFail($id);
        $city->update($request->all());
        flash()->success('Updated');
        return redirect(route('districts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = District::find($id);
        $record->delete();
        flash()->error('Deleted');
        return redirect(route('districts.index'));
    }
}
