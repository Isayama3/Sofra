@extends('layouts.master')
@inject('permissions', 'Spatie\Permission\Models\permission')

@section('page_title')
    Edit Role
@endsection
@section('content')

            {!! Form::model($model,[
               'action'=> ['RolesController@update',$model->id],
               'method' => 'put'
            ]) !!}
            <div class="form-group row">
                <label for="name">Name</label>
                {!! Form::text('name', null , [
                    'class' =>'form-control'
                ]) !!}
                <label for="description">Description</label>
                {!! Form::textarea('description', null , [
                 'rows' => '2',
                 'class' =>'form-control'
                ]) !!}
            </div>
            <input type="checkbox" id="select-all">
            <label for="selectAll" class="ml-1">Select All</label>
            <div class="row">
                @foreach($permissions->all() as $permission)
                    <div class=" col-sm-3 col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="permission_list[]" value="{{$permission->id}}"
                                       @if($model->hasPermissionTo($permission->name))
                                       checked
                                @endif
                            </label>
                            <label> {{$permission->name}}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                {!! Form::submit('Update', [
                    'class' => 'btn btn-primary'
                ]) !!}
            </div>
            {!! Form::close() !!}



@endsection
@push('scripts')
    <script>
        $("#select-all").click(function(){
            $("input[type=checkbox]").prop('checked',$(this).prop('checked'));
        });
    </script>

@endpush
