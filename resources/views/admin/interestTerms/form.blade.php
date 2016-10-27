@extends('layouts.app')

@section('contentheader_title', $interestTerm->exists ? 'Editing ' . $interestTerm->name : 'Add New InterestTerm')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('admin.interestTerms.index') }}"><i class="fa fa-angle-double-left"></i> Back to all interestTerms</a><br /><br />

        {!! Form::model($interestTerm, [
            'method' => $interestTerm->exists ? 'put' : 'post',
            'route' => $interestTerm->exists
                ? ['admin.interestTerms.update', $interestTerm->id]
                : ['admin.interestTerms.store']
        ]) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>InterestTerm Information</legend>

                    <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
                        {!! Form::label('term', 'InterestTerm Term') !!}
                        {!! Form::text('term', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

                        @if ($errors->has('term'))
                            <span class="help-block">
                                <strong>{{ $errors->first('term') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($interestTerm->exists ? 'Save InterestTerm' : 'Create New InterestTerm', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
