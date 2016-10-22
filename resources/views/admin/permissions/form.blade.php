@extends('layouts.app')

@section('contentheader_title', $permission->exists ? 'Editing ' . $permission->name : 'Add New Permission')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.permissions.index') }}"><i class="fa fa-angle-double-left"></i> Back to all permissions</a><br /><br />

        {!! Form::model($permission, [
            'method' => $permission->exists ? 'put' : 'post',
            'route' => $permission->exists
                ? ['admin.permissions.update', $permission->id]
                : ['admin.permissions.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Permission Information</legend>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('roles', 'Roles') !!}

                        <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('roles[]', $role->name, $permission->exists ? $role->hasPermissionTo($permission->name) : false) !!}
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($permission->exists ? 'Save Permission' : 'Create New Permission', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
