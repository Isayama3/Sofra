@extends('layouts.master')
@section('page_title')
    Contacts
@endsection


@section('content')
    @include('flash::message')
    <div class="row d-flex align-items-stretch">
        @foreach ($records as $record)
            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                <div class="card bg-light">
                    <div class="card-header text-muted">
                        <p class="text-muted text-sm mb-0"><b>Message: </b> {{substr($record->message,0,'60')}} ......  </p>
                    </div>
                    <div class="card-body pt-0 mt-2">
                        <div class="row">
                            <div class="col-12">
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="medium mb-1"><span class="fa-li"><i class="fas fa-lg fa-filter"></i></span> Type: {{$record->type}}</li>
                                    <li class="medium mb-1"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Name: {{$record->name}}</li>
                                    <li class="medium mb-1"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Email: {{$record->email}}</li>
                                    <li class="medium mb-1"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : {{$record->phone}}</li>
                                    <li class="medium mb-1"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Date : {{$record->created_at}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row col-md-12">
{{--                            <div class="mr-1"><a href="{{url(route('districts.edit',$record->id))}}" class="btn btn-success"><i class="fa fa-edit"></i> View</a></div>--}}
                            {!! Form::open([
                                'action' => ['ContactsController@destroy',$record->id],
                                'method' => 'delete'
                                ]) !!}
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    @include('partials.pagination')

@endsection
