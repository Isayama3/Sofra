@extends('layouts.master')
@section('page_title')
    Restaurants
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
                <th scope="col">Min Price</th>
                <th scope="col">Max Price</th>
                <th scope="col">Delivery Cost</th>
                <th scope="col">WhatsApp</th>
                <th scope="col">Restaurant Phone</th>
                <th scope="col">Status</th>
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
                    <td>{{$record->min_price}}</td>
                    <td>{{$record->max_price}}</td>
                    <td>{{$record->delivery_cost}}</td>
                    <td>{{$record->whatsapp}}</td>
                    <td>{{$record->restaurant_phone}}</td>
                    <td>{{$record->status}}</td>
                    <td>
                        {!! Form::open([
                        'action' => ['RestaurantsController@destroy',$record->id],
                        'method' => 'delete'
                        ]) !!}
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        @if ($record->activation == 1)
                            {!! Form::open([
                            'action' => ['RestaurantsController@update',$record->id],
                            'method' => 'put'
                            ]) !!}
                            <button class="btn btn-warning"><i class="fas fa-times-circle"></i> Deactivate </button>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open([
                            'action' => ['RestaurantsController@update',$record->id],
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
