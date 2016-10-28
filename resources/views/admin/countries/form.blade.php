@extends('layouts.app')

@section('contentheader_title', $country->exists ? 'Editing ' . $country->name : 'Add New Country')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.countries.index') }}"><i class="fa fa-angle-double-left"></i> Back to all countries</a><br /><br />

        {!! Form::model($country, [
            'method' => $country->exists ? 'put' : 'post',
            'route' => $country->exists
                ? ['admin.countries.update', $country->id]
                : ['admin.countries.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Country Information</legend>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Country Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('default_currency_id') ? ' has-error' : '' }}">
                        {!! Form::label('default_currency_id', 'DefaultCurrency') !!}
                        {!! Form::select(
                                'default_currency_id',
                                $currencies->pluck('name', 'id'),
                                null,
                                array(
                                    'placeholder' => 'Select a DefaultCurrency',
                                    'class'       => 'form-control'
                                )
                            ) !!}

                        @if ($errors->has('default_currency_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('default_currency_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('local_short_form') ? ' has-error' : '' }}">
                        {!! Form::label('local_short_form', 'LocalShortForm') !!}
                        {!! Form::text('local_short_form', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('local_short_form'))
                            <span class="help-block">
                                <strong>{{ $errors->first('local_short_form') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                        {!! Form::label('abbreviation', 'Abbreviation') !!}
                        {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('abbreviation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('abbreviation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('iso_alpha_2') ? ' has-error' : '' }}">
                        {!! Form::label('iso_alpha_2', 'ISOAlpha2') !!}
                        {!! Form::text('iso_alpha_2', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('iso_alpha_2'))
                            <span class="help-block">
                                <strong>{{ $errors->first('iso_alpha_2') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('iso_alpha_3') ? ' has-error' : '' }}">
                        {!! Form::label('iso_alpha_3', 'ISOAlpha3') !!}
                        {!! Form::text('iso_alpha_3', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('iso_alpha_3'))
                            <span class="help-block">
                                <strong>{{ $errors->first('iso_alpha_3') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('telephone_code') ? ' has-error' : '' }}">
                        {!! Form::label('telephone_code', 'TelephoneCode') !!}
                        {!! Form::number('telephone_code', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('telephone_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telephone_code') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('tld') ? ' has-error' : '' }}">
                        {!! Form::label('tld', 'Tld') !!}
                        {!! Form::text('tld', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('tld'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tld') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('is_enabled', null, $country->is_enabled) !!}
                            Enabled
                        </label>
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($country->exists ? 'Save Country' : 'Create New Country', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
