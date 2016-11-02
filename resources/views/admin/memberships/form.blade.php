@extends('layouts.app')

@section('contentheader_title', $membership->exists ? 'Editing ' . $membership->name : 'Add New Membership')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.memberships.index') }}"><i class="fa fa-angle-double-left"></i> Back to all memberships</a><br /><br />

        {!! Form::model($membership, [
            'method' => $membership->exists ? 'put' : 'post',
            'route' => $membership->exists
                ? ['admin.memberships.update', $membership->id]
                : ['admin.memberships.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Membership Information</legend>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Membership Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($membership->exists ? 'Save Membership' : 'Create New Membership', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
