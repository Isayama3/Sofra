@extends('layouts.master')
@inject('cities','App\Models\City)
@section('page_title')
    Edit District
@endsection
@section('content')

            {!! Form::model($model,[
               'action'=> ['DistrictsController@update',$model->id],
               'method' => 'put'
            ]) !!}
            <div class="form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null , [
                    'class' =>'form-control'
                ]) !!}
                <label for="name">City</label>
                {!! Form::select('city_id',$cities->pluck('name','id'),null, [
                    'class' =>'form-control'
                ]) !!}
            </div>
            {!! Form::submit('Update', [
                'class' => 'btn btn-primary float-right form-group'
            ]) !!}
            {!! Form::close() !!}



@endsection
