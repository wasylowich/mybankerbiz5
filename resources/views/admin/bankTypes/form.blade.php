@extends('layouts.app')

@section('contentheader_title', $bankType->exists ? 'Editing ' . $bankType->name : 'Add New BankType')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.bankTypes.index') }}"><i class="fa fa-angle-double-left"></i> Back to all bankTypes</a><br /><br />

        {!! Form::model($bankType, [
            'method' => $bankType->exists ? 'put' : 'post',
            'route' => $bankType->exists
                ? ['admin.bankTypes.update', $bankType->id]
                : ['admin.bankTypes.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>BankType Information</legend>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        {!! Form::label('type', 'BankType Type') !!}
                        {!! Form::text('type', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($bankType->exists ? 'Save BankType' : 'Create New BankType', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
