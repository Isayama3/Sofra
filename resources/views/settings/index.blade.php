@extends('layouts.master')
@section('page_title')
    Settings
@endsection


@section('content')
    @include('flash::message')

    <div class="table-responsive">
        <table class="table table-hover">
            @foreach ($records as $record)
                <tbody>
                <tr>
                    <th scope="row">About App</th>
                    <td>{{$record->about_app}}</td>
                </tr>
                <tr>
                    <th scope="row">App Commission</th>
                    <td>{{$record->app_commission}}</td>
                </tr>
                <tr>
                    <th scope="row">Alahly Account Num</th>
                    <td>{{$record->alahly_account_num}}</td>
                </tr>
                <tr>
                    <th scope="row">Raghy Account Num</th>
                    <td>{{$record->raghy_account_num}}</td>
                </tr>
                <tr>
                    <th scope="row">Account Name</th>
                    <td>{{$record->account_name}}</td>
                </tr>


                </tbody>
            @endforeach


        </table>
        <a href="{{url(route('settings.edit',$record->id))}}" class="btn-lg btn-success float-right"><i class="fa fa-edit"></i>Edit</a>

    </div>
@endsection
