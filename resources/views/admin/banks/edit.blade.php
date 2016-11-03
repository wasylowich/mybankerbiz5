@extends('layouts.app')

@section('contentheader_title', 'Editing ' . $bank->name)

@section('main-content')
<div class="row">
    <div class="col-md-12">

        <a href="{{ route('admin.banks.index') }}"><i class="fa fa-angle-double-left"></i> Back to all banks</a><br /><br />

        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#bank" data-toggle="tab">Basic Information</a>
            </li>
            <li>
                <a href="#bankProfile" data-toggle="tab">Profile</a>
            </li>
            <li>
                <a href="#bankLogo" data-toggle="tab">Logo</a>
            </li>
        </ul>

        <div class="tab-content ">
            <div class="tab-pane active" id="bank">
                {!! Form::model($bank, [
                    'method' => 'put',
                    'route' => ['admin.banks.update', $bank->id]
                ]) !!}

                <!-- Default box -->
                <div class="box">
                    <div class="box-body row">
                        <fieldset class="col-sm-12">
                            <legend>Bank Basic Information</legend>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Bank Name') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                {!! Form::label('country_id', 'Country') !!}
                                {!! Form::select(
                                        'country_id',
                                        $countries->pluck('name', 'id'),
                                        null,
                                        array(
                                            'placeholder' => 'Select a Country',
                                            'class'       => 'form-control'
                                        )
                                    ) !!}

                                @if ($errors->has('country_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('vatin') ? ' has-error' : '' }}">
                                {!! Form::label('vatin', 'CVR') !!}
                                {!! Form::text('vatin', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('vatin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vatin') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                {!! Form::label('website', 'Website') !!}
                                {!! Form::text('website', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>
                                    {!! Form::checkbox('is_active', null, $bank->is_active) !!}
                                    Active
                                </label>
                            </div>

                            <div class="form-group{{ $errors->has('bank_type_id') ? ' has-error' : '' }}">
                                {!! Form::label('bank_type_id', 'BankType') !!}
                                {!! Form::select(
                                        'bank_type_id',
                                        $bankTypes->pluck('type', 'id'),
                                        null,
                                        array(
                                            'placeholder' => 'Select a BankType',
                                            'class'       => 'form-control'
                                        )
                                    ) !!}

                                @if ($errors->has('bank_type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('interest_convention_id') ? ' has-error' : '' }}">
                                {!! Form::label('interest_convention_id', 'InterestConvention') !!}
                                {!! Form::select(
                                        'interest_convention_id',
                                        $interestConventions->pluck('convention', 'id'),
                                        null,
                                        array(
                                            'placeholder' => 'Select a InterestConvention',
                                            'class'       => 'form-control'
                                        )
                                    ) !!}

                                @if ($errors->has('interest_convention_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('interest_convention_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('interest_term_id') ? ' has-error' : '' }}">
                                {!! Form::label('interest_term_id', 'InterestTerm') !!}
                                {!! Form::select(
                                        'interest_term_id',
                                        $interestTerms->pluck('term', 'id'),
                                        null,
                                        array(
                                            'placeholder' => 'Select a InterestTerm',
                                            'class'       => 'form-control'
                                        )
                                    ) !!}

                                @if ($errors->has('interest_term_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('interest_term_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('pension_interest_convention_id') ? ' has-error' : '' }}">
                                {!! Form::label('pension_interest_convention_id', 'PensionInterestConvention') !!}
                                {!! Form::select(
                                        'pension_interest_convention_id',
                                        $interestConventions->pluck('convention', 'id'),
                                        null,
                                        array(
                                            'placeholder' => 'Select a PensionInterestConvention',
                                            'class'       => 'form-control'
                                        )
                                    ) !!}

                                @if ($errors->has('pension_interest_convention_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pension_interest_convention_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>
                                    {!! Form::checkbox('change_of_control', null, $bank->change_of_control) !!}
                                    Change of control
                                </label>
                            </div>

                            <div class="form-group{{ $errors->has('rebate_type_id') ? ' has-error' : '' }}">
                                {!! Form::label('rebate_type_id', 'RebateType') !!}
                                {!! Form::select(
                                        'rebate_type_id',
                                        $rebateTypes->pluck('type', 'id'),
                                        null,
                                        array(
                                            'placeholder' => 'Select a RebateType',
                                            'class'       => 'form-control'
                                        )
                                    ) !!}

                                @if ($errors->has('rebate_type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rebate_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('rebate_message', 'RebateMessage') !!}
                                {!! Form::textarea('rebate_message', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-xs-12">
                                {!! Form::submit('Save Bank', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="bankProfile">
                {!! Form::model($bank->profile, [
                    'method' => 'put',
                    'route' => ['admin.banks.updateprofile', $bank->id]
                ]) !!}

                <!-- Default box -->
                <div class="box">
                    <div class="box-body row">
                        <fieldset class="col-sm-12">
                            <legend>Bank Profile</legend>

                            <div class="form-group{{ $errors->has('annual_report') ? ' has-error' : '' }}">
                                {!! Form::label('annual_report', 'AnnualReport') !!}
                                {!! Form::text('annual_report', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('annual_report'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('annual_report') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('bio', 'Bio') !!}
                                {!! Form::textarea('bio', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-xs-12">
                                {!! Form::submit('Save Bank Profile', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="bankLogo">
                {!! Form::model($bank->profile, [
                    'method' => 'post',
                    'route' => ['admin.banks.updatelogo', $bank->id],
                    'files' => true
                ]) !!}

                <!-- Default box -->
                <div class="box">
                    <div class="box-body row">
                        <fieldset class="col-sm-12">
                            <legend>Bank Logo</legend>

                            <div class="row">
                                <div class="col-sm-6" style="text-align:center">
                                    <img src="{{ asset($bank->logo()) }}" style="width:250px; height:100px; margin-right:25px;" alt="Bank Logo" />
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {!! Form::label('logo', 'Logo') !!}
                                        {!! Form::file('logo', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                                        @if ($errors->has('logo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('logo') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-xs-12">
                                        {!! Form::submit('Save Logo', ['class' => 'btn btn-primary']) !!}
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
