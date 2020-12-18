@extends('layouts.master')
@section('page_title')
    Order
@endsection

@section('content')
        <div class="row">
            <div class="col-md-6">
                <address>
                    <strong>{{$items->restaurant()->pluck('name')->first()}}</strong>
                    <br>
                    <strong>Address : </strong> {{$items->restaurant->district()->pluck('name')->first()}}

                    <br>

                    <strong>Phone : </strong> {{$items->restaurant()->pluck('phone')->first()}}
                </address>
            </div>
            <div class="col-md-6 text-right">
                <p>
                    <em>Date : {{$items->created_at->toDateString()}}</em>
                </p>
                <p>
                    <em>Time : {{$items->created_at->format('H:i')}}</em>
                </p>
                <p>
                    <em>Receipt #: {{$items->id}}</em>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <h1>Receipt</h1>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>#</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items->products as $item)
                <tr>
                    <td class="col-md-9"><em>{{$item->pluck('name')->first()}}</em></td>
                    <td class="col-md-1" style="text-align: center"> {{$item->pivot->quantity}} </td>
                    <td class="col-md-1 text-center">${{$item->pivot->price}}</td>
                    <td class="col-md-1 text-center">${{($item->pivot->price)*($item->pivot->quantity)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td class="text-right">
                        <p>
                            <strong>Subtotal:&nbsp;</strong>
                        </p>
                        <p>
                            <strong>Delivery:&nbsp;</strong>
                        </p>
                    </td>
                    <td class="text-center">
                        <p>
                            <strong>${{$items->cost}}</strong>
                        </p>
                        <p>
                            <strong>${{$items->delivery_cost}}</strong>
                        </p></td>
                </tr>
                <tr>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td class="text-right"><h4><strong>Total:&nbsp;</strong></h4></td>
                    <td class="text-center text-danger"><h4><strong>${{$items->total}}</strong></h4></td>
                </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-success btn-lg btn-block">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
@endsection()
