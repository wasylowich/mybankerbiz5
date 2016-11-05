@extends('layouts.app')

@section('contentheader_title', $depositorType->exists ? 'Editing ' . $depositorType->name : 'Add New DepositorType')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.depositorTypes.index') }}"><i class="fa fa-angle-double-left"></i> Back to all depositorTypes</a><br /><br />

        {!! Form::model($depositorType, [
            'method' => $depositorType->exists ? 'put' : 'post',
            'route' => $depositorType->exists
                ? ['admin.depositorTypes.update', $depositorType->id]
                : ['admin.depositorTypes.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>DepositorType Information</legend>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'DepositorType Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($depositorType->exists ? 'Save DepositorType' : 'Create New DepositorType', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
