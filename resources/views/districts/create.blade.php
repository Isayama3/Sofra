@extends('layouts.master')
@inject('model', 'App\Models\District')
@inject('cities','App\Models\City)
@section('page_title')
    Add New District
@endsection

@section('content')
    {!! Form::model($model,[
       'action'=> 'DistrictsController@store'
    ]) !!}
    <div class="form-group">
        <label for="name">Name</label>
        {!! Form::text('name', null , [
            'class' =>'form-control'
        ]) !!}
        <label for="name">City</label>
        {!! Form::select('city_id',$cities->pluck('name','id'),1, [
            'class' =>'form-control'
        ]) !!}
    </div>
    <div class="form-group float-right">
        {!! Form::submit('Add', [
            'class' => 'btn btn-primary'
        ]) !!}
    </div>
    {!! Form::close() !!}
@endsection
