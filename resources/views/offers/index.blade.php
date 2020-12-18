@extends('layouts.master')
@section('page_title')
    Offers
@endsection


@section('content')
    @include('flash::message')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Discount</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Restaurant</th>
                <th scope="col">Pic</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($records as $record)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$record->name}}</td>
                    <td>{{$record->discount}}</td>
                    <td>{{$record->from}}</td>
                    <td>{{$record->to}}</td>
                    <td>{{$record->name}}</td>
                    <td>{{$record->pic}}</td>
                    <td class="row col-md-12">
                        <div class="">
                            {!! Form::open([
                            'action' => ['OffersController@destroy',$record->id],
                            'method' => 'delete'
                            ]) !!}
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('partials.pagination')

@endsection
