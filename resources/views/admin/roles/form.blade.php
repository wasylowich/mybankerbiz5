@extends('layouts.app')

@section('contentheader_title', $role->exists ? 'Editing ' . $role->name : 'Add New Role')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.roles.index') }}"><i class="fa fa-angle-double-left"></i> Back to all roles</a><br /><br />

        {!! Form::model($role, [
            'method' => $role->exists ? 'put' : 'post',
            'route' => $role->exists
                ? ['admin.roles.update', $role->id]
                : ['admin.roles.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Role Information</legend>

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
                        {!! Form::label('permissions', 'Permissions') !!}

                        <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('permissions[]', $permission->name, $role->exists ? $role->hasPermissionTo($permission->name) : false) !!}
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($role->exists ? 'Save Role' : 'Create New Role', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
