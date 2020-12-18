@extends('layouts.master')
@section('page_title')
    Payments
@endsection
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Restaurant</th>
                <th scope="col">Restaurant Sales</th>
                <th scope="col">App Commission</th>
                <th scope="col">Paid Money</th>
                <th scope="col">Rest Of Money</th>
                <th scope="col">Notes</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$record->restaurant()->pluck('name')->first()}}</td>
                        <td>{{$record->restaurant_sales}}</td>
                        <td>{{$record->app_commission}}</td>
                        <td>{{$record->paid_money}}</td>
                        <td>{{$record->rest_of_money}}</td>
                        <td>{{$record->notes}}</td>


                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    @include('partials.pagination')

@endsection
