@extends('layouts.depositor')

@section('contentheader_title', $depositorProfile->exists ? 'Editing ' . $depositorProfile->name : 'Add New DepositorProfile')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('depositor.depositorProfiles.index') }}"><i class="fa fa-angle-double-left"></i> Back to all depositorProfiles</a><br /><br />

        {!! Form::model($depositorProfile, [
            'method' => $depositorProfile->exists ? 'put' : 'post',
            'route' => $depositorProfile->exists
                ? ['depositor.depositorProfiles.update', $depositorProfile->id]
                : ['depositor.depositorProfiles.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>DepositorProfile Information</legend>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'DepositorProfile Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('depositor_type_id') ? ' has-error' : '' }}">
                        {!! Form::label('depositor_type_id', 'DepositorType') !!}
                        {!! Form::select(
                                'depositor_type_id',
                                $depositorTypes->pluck('name', 'id'),
                                null,
                                array(
                                    'placeholder' => 'Select a DepositorType',
                                    'class'       => 'form-control'
                                )
                            ) !!}

                        @if ($errors->has('depositor_type_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('depositor_type_id') }}</strong>
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

                    <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
                        {!! Form::label('pin', 'CPR') !!}
                        {!! Form::text('pin', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('pin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('is_primary', null, $depositorProfile->is_primary) !!}
                            Primary
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('is_active', null, $depositorProfile->is_active) !!}
                            Active
                        </label>
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($depositorProfile->exists ? 'Save DepositorProfile' : 'Create New DepositorProfile', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
