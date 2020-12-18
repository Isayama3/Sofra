@extends('layouts.master')
@section('page_title')
    Orders
@endsection
<?php

?>

@section('content')
    @include('flash::message')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Receipt #</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($records as $record)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$record->products()->pluck('name')->first()}}</td>
                    <td>{{$record->address}}</td>
                    <td>{{$record->created_at->toDateString()}}</td>
                    <td>{{$record->created_at->format('H:i')}}</td>
                    <td>{{$record->status}}</td>
                    <td class="row col-md-12">
                        <div class="mr-1"><a href="{{url(route('orders.show',$record->id))}}" class="btn btn-success"><i class="fa fa-eye"></i> Show</a></div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('partials.pagination')

@endsection
