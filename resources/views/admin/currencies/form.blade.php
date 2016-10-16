@extends('layouts.app')

@section('contentheader_title', $currency->exists ? 'Editing ' . $currency->name : 'Add New Currency')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.currencies.index') }}"><i class="fa fa-angle-double-left"></i> Back to all currencies</a><br /><br />

        {!! Form::model($currency, [
            'method' => $currency->exists ? 'put' : 'post',
            'route' => $currency->exists ? ['admin.currencies.update', $currency->id] : ['admin.currencies.store']
        ]) !!}
        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Currency Information</legend>

                    <div class="form-group">
                        {!! Form::label('name', 'Currency Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('code', 'Currency Code') !!}
                        {!! Form::text('code', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('precision', 'Decimal Point Precision') !!}
                        {!! Form::number('precision', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-xs-12">
                        {!! Form::submit($currency->exists ? 'Save Currency' : 'Create New Currency', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
