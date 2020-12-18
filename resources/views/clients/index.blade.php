@extends('layouts.master')
@section('page_title')
    Clients
@endsection

@section('content')
    @include('flash::message')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">District</th>
                <th scope="col">Delete</th>
                <th scope="col">Activate/Deactivate</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($records as $record)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$record->name}}</td>
                    <td>{{$record->email}}</td>
                    <td>{{$record->phone}}</td>
                    <td>{{$record->district()->pluck('name')->first()}}</td>
                    <td>
                        {!! Form::open([
                        'action' => ['ClientsController@destroy',$record->id],
                        'method' => 'delete'
                        ]) !!}
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        @if ($record->activation == 1)
                            {!! Form::open([
                            'action' => ['ClientsController@update',$record->id],
                            'method' => 'put'
                            ]) !!}
                            <button class="btn btn-warning"><i class="fas fa-times-circle"></i> Deactivate </button>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open([
                            'action' => ['ClientsController@update',$record->id],
                            'method' => 'put'
                            ]) !!}
                            <button class="btn btn-success"><i class="fas fa-check-circle"></i> Activate</button>
                            {!! Form::close() !!}
                        @endif


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('partials.pagination')

@endsection
