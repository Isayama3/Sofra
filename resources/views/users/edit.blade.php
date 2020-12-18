@extends('layouts.master')
@inject('role', 'Spatie\Permission\Models\Role')
<?php
$roles = $role->pluck('name','id')->toArray();
?>
@section('page_title')
    Edit User
@endsection
@section('content')



            {!! Form::model($model,[
               'action'=> ['UsersController@update',$model->id],
               'method' => 'put',
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
                <label for="roles_list">Roles</label>
                <div class="select2-purple">
                    {!! Form::select('roles_list[]',$roles, null ,[
                    'class' =>'form-control select2-purple js-example-basic-multiple',
                    'multiple' => 'multiple',
                    'data-dropdown-css-class'=>'select2-purple',
                    'data-placeholder'=>'Select Roles'
                ]) !!}
                </div>

            </div>
            <div class="form-group">
                {!! Form::submit('Update', [
                    'class' => 'btn btn-primary'
                ]) !!}
            </div>
            {!! Form::close() !!}
@endsection
