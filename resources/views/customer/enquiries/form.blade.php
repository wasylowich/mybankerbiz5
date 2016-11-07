@extends('layouts.customer')

@section('contentheader_title', $enquiry->exists ? 'Editing ' . $enquiry->name : 'Add New Enquiry')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('customer.enquiries.index') }}"><i class="fa fa-angle-double-left"></i> Back to all enquiries</a><br /><br />

        {!! Form::model($enquiry, [
            'method' => $enquiry->exists ? 'put' : 'post',
            'route' => $enquiry->exists
                ? ['customer.enquiries.update', $enquiry->id]
                : ['customer.enquiries.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Enquiry Information</legend>

                    <div class="form-group{{ $errors->has('depositor_profile_id') ? ' has-error' : '' }}">
                        {!! Form::label('depositor_profile_id', 'DepositorProfile') !!}
                        {!! Form::select(
                                'depositor_profile_id',
                                $depositorProfiles->pluck('name', 'id'),
                                null,
                                array(
                                    'placeholder' => 'Select a DepositorProfile',
                                    'class'       => 'form-control'
                                )
                            ) !!}

                        @if ($errors->has('depositor_profile_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('depositor_profile_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('deposit_type_id') ? ' has-error' : '' }}">
                        {!! Form::label('deposit_type_id', 'DepositType') !!}
                        {!! Form::select(
                                'deposit_type_id',
                                $depositTypes->pluck('name', 'id'),
                                null,
                                array(
                                    'placeholder' => 'Select a DepositType',
                                    'class'       => 'form-control'
                                )
                            ) !!}

                        @if ($errors->has('deposit_type_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('deposit_type_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        {!! Form::label('amount', 'Amount') !!}
                        {!! Form::number('amount', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('currency_id') ? ' has-error' : '' }}">
                        {!! Form::label('currency_id', 'Currency') !!}
                        {!! Form::select(
                                'currency_id',
                                $currencies->pluck('code', 'id'),
                                null,
                                array(
                                    'placeholder' => 'Select a Currency',
                                    'class'       => 'form-control'
                                )
                            ) !!}

                        @if ($errors->has('currency_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('fixation_period_start_date') ? ' has-error' : '' }}">
                        {!! Form::label('fixation_period_start_date', 'FixationPeriodStartDate') !!}
                        {!! Form::text('fixation_period_start_date', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('fixation_period_start_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fixation_period_start_date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('fixation_period_end_date') ? ' has-error' : '' }}">
                        {!! Form::label('fixation_period_end_date', 'FixationPeriodEndDate') !!}
                        {!! Form::text('fixation_period_end_date', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('fixation_period_end_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fixation_period_end_date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($enquiry->exists ? 'Save Enquiry' : 'Create New Enquiry', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
