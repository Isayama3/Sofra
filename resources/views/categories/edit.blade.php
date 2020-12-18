@extends('layouts.master')
@section('page_title')
    Edit Category
@endsection
@section('content')

            {!! Form::model($model,[
               'action'=> ['CategoriesController@update',$model->id],
               'method' => 'put'
            ]) !!}
            <div class="form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null , [
                    'class' =>'form-control'
                ]) !!}
            </div>
            {!! Form::submit('Update', [
                'class' => 'btn btn-primary float-right form-group'
            ]) !!}
            {!! Form::close() !!}



@endsection
