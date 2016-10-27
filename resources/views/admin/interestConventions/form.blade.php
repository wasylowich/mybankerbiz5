@extends('layouts.app')

@section('contentheader_title', $interestConvention->exists ? 'Editing ' . $interestConvention->name : 'Add New InterestConvention')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.interestConventions.index') }}"><i class="fa fa-angle-double-left"></i> Back to all interestConventions</a><br /><br />

        {!! Form::model($interestConvention, [
            'method' => $interestConvention->exists ? 'put' : 'post',
            'route' => $interestConvention->exists
                ? ['admin.interestConventions.update', $interestConvention->id]
                : ['admin.interestConventions.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>InterestConvention Information</legend>

                    <div class="form-group{{ $errors->has('convention') ? ' has-error' : '' }}">
                        {!! Form::label('convention', 'InterestConvention Convention') !!}
                        {!! Form::text('convention', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('convention'))
                            <span class="help-block">
                                <strong>{{ $errors->first('convention') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($interestConvention->exists ? 'Save InterestConvention' : 'Create New InterestConvention', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
