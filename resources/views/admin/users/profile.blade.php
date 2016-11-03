@extends('layouts.app')

@section('contentheader_title', 'User Profile')

@section('main-content')
<div class="row">
    <div class="col-md-4">

        {!! Form::model($user, [
            'method' => 'post',
            'route' => ['admin.users.avatar'],
            'files' => true
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>User Avatar</legend>

                    <div class="row">
                        <div class="col-sm-6" style="text-align:center">
                            <img src="{{ asset($user->avatar()) }}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;" alt="User Image" />
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
    <div class="col-md-4">

        {!! Form::model($user, [
            'method' => 'put',
            'route' => ['admin.users.profile']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>User Information</legend>

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

                    <div class="col-xs-12">
                        {!! Form::submit('Save User Profile', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
    <div class="col-md-4">

        {!! Form::model($user, [
            'method' => 'put',
            'route' => ['admin.users.password']
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
</div>
@endsection
