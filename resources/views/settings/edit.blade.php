@extends('layouts.master')
@section('page_title')
    Edit Settings
@endsection
@section('content')

            {!! Form::model($model,[
               'action'=> ['SettingsController@update',$model->id],
               'method' => 'put'
            ]) !!}
            <div class="form-group">
                <label for="name">About App</label>
                {!! Form::text('about_app', null , [
                    'class' =>'form-control'
                ]) !!}
                <label for="name">App Commission</label>
                {!! Form::text('app_commission', null , [
                    'class' =>'form-control'
                ]) !!}
                <label for="name">Alahly Account Num</label>
                {!! Form::text('alahly_account_num', null , [
                    'class' =>'form-control'
                ]) !!}
                <label for="name">Raghy Account Num</label>
                {!! Form::text('raghy_account_num', null , [
                    'class' =>'form-control'
                ]) !!}
                <label for="name">Account Name</label>
                {!! Form::text('account_name', null , [
                    'class' =>'form-control'
                ]) !!}

            </div>
            {!! Form::submit('Update', [
                'class' => 'btn btn-primary float-right form-group'
            ]) !!}
            {!! Form::close() !!}



@endsection
