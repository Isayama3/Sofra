@extends('layouts.master')
@section('page_title')
    Edit User
@endsection
@section('content')

    {!! Form::model($model,[
       'route'=> ['profileUpdate',$model->id],
       'method' => 'post',
       'enctype'=>'multipart/form-data'
    ]) !!}
    <div class="form-group">
        <label for="title">Name</label>
        {!! Form::text('name', null , [
            'class' =>'form-control'
        ]) !!}
        <label for="email">Email</label>
        {!! Form::email('email', null , [
            'class' =>'form-control'
        ]) !!}
        <label for="password">Password</label>
        {!! Form::password('password', [
            'class' =>'form-control'
        ]) !!}<label for="password_confirmation">Confirm Password</label>
        {!! Form::password('password_confirmation' , [
            'class' =>'form-control'
        ]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update', [
            'class' => 'btn btn-primary'
        ]) !!}
    </div>
    {!! Form::close() !!}
@endsection
