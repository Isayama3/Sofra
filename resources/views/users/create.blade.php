@extends('layouts.master')

@section('page_title')
    New User
@endsection
@section('content')

            {!! Form::model($model,[
               'action'=> 'UsersController@store'
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
                {!! Form::select('roles_list[]',$roles, null ,[
                    'class' =>'form-control',
                    'multiple' => 'multiple'
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Add', [
                    'class' => 'btn btn-primary'
                ]) !!}
            </div>
            {!! Form::close() !!}

@endsection
