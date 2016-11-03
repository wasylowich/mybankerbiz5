@extends('layouts.app')

@section('contentheader_title', 'Editing ' . $user->name)

@section('main-content')
<div class="row">
    <div class="col-md-12">

        <a href="{{ route('admin.users.index') }}"><i class="fa fa-angle-double-left"></i> Back to all users</a><br /><br />

        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#user" data-toggle="tab">Basic Information</a>
            </li>
            <li>
                <a href="#changePassword" data-toggle="tab">Password</a>
            </li>
            <li>
                <a href="#userAvatar" data-toggle="tab">Avatar</a>
            </li>
        </ul>

        <div class="tab-content ">
            <div class="tab-pane active" id="user">
                {!! Form::model($user, [
                    'method' => 'put',
                    'route' => ['admin.users.update', $user->id]
                ]) !!}

                <!-- Default box -->
                <div class="box">
                    <div class="box-body row">
                        <fieldset class="col-sm-12">
                            <legend>User Basic Information</legend>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('roles', 'User Role Permissions') !!}

                                <div class="row">
                                @foreach ($roles as $role)
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('roles[]', $role->name, $user->exists ? $user->hasRole($role->name) : false) !!}
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="col-xs-12">
                                {!! Form::submit('Save User', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="changePassword">

                {!! Form::model($user, [
                    'method' => 'put',
                    'route' => ['admin.users.changepassword', $user->id]
                ]) !!}

                <!-- Default box -->
                <div class="box">
                    <div class="box-body row">
                        <fieldset class="col-sm-12">
                            <legend>Change Password</legend>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-xs-12">
                                {!! Form::submit('Change Password', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="userAvatar">
                {!! Form::model($user->profile, [
                    'method' => 'post',
                    'route' => ['admin.users.updateavatar', $user->id],
                    'files' => true
                ]) !!}

                <!-- Default box -->
                <div class="box">
                    <div class="box-body row">
                        <fieldset class="col-sm-12">
                            <legend>User Avatar</legend>

                            <div class="row">
                                <div class="col-sm-6" style="text-align:center">
                                    <img src="{{ asset($user->avatar()) }}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;" alt="User Avatar" />
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {!! Form::label('avatar', 'Avatar') !!}
                                        {!! Form::file('avatar', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-xs-12">
                                        {!! Form::submit('Save Avatar', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>
@endsection
