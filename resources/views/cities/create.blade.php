@extends('layouts.master')
@inject('model', 'App\Models\City')
@section('page_title')
    Add New City
@endsection

@section('content')
    {!! Form::model($model,[
       'action'=> 'CitiesController@store'
    ]) !!}
    <div class="form-group">
        <label for="name">Name</label>
        {!! Form::text('name', null , [
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
