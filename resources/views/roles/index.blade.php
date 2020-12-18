@extends('layouts.master')
@section('page_title')
    Roels
@endsection


@section('content')
    <a href="{{url(route('roles.create'))}}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> New Role</a>
    @include('flash::message')
    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$record->name}}</td>
                        <td class="row col-md-12">
                            <div class="mr-1"><a href="{{url(route('roles.edit',$record->id))}}" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a></div>
                            <div class="">
                                {!! Form::open([
                                'action' => ['RolesController@destroy',$record->id],
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
