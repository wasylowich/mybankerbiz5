@extends('layouts.banker')

@section('contentheader_title', $offer->exists ? 'Editing ' . $offer->name : 'Make an Offer')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <a href="{{ route('banker.offerChances.index') }}"><i class="fa fa-angle-double-left"></i> Back to all OfferChances</a><br /><br />

        {!! Form::model($offer, [
            'method' => $offer->exists ? 'put' : 'post',
            'route' => $offer->exists
                ? ['banker.offers.update', $offer->id]
                : ['banker.offers.store']
        ]) !!}

        {!! Form::hidden('offer_chance_id', $offerChance->id) !!}

        <!-- Default box -->
        <div class="box">
            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Offer Information</legend>

                    <div class="row">
                        <div class="col-xs-2 col-sm-3">Bank:</div><div class="col-xs-10 col-sm-9"><strong>{{ $offerChance->bank->name }}</strong></div>
                        <div class="col-xs-2 col-sm-3">Bidder:</div><div class="col-xs-10 col-sm-9"><strong>{{ Auth::user()->name }}</strong></div>
                        <!-- <div class="col-xs-2 col-sm-3">Related to enquiry:</div><div class="col-xs-10 col-sm-9"><strong>{{ $offerChance->enquiry->id }}</strong></div> -->
                        <div class="col-xs-2 col-sm-3">Currency:</div><div class="col-xs-10 col-sm-9"><strong>{{ $offerChance->enquiry->currency->code }}</strong></div>
                        <div class="col-xs-2 col-sm-3">Amount:</div><div class="col-xs-10 col-sm-9"><strong>{{ $offerChance->enquiry->amount }}</strong></div>
                        <div class="col-xs-2 col-sm-3">Type:</div><div class="col-xs-10 col-sm-9"><strong>{{ $offerChance->enquiry->depositType->name }}</strong></div>
                        @if ($offerChance->enquiry->depositType->name == 'period')
                        <div class="col-xs-2 col-sm-3">Period:</div><div class="col-xs-10 col-sm-9"><strong>{{ $offerChance->enquiry->fixation_period }} Days</strong></div>
                        @endif
                    </div>

                    <p>&nbsp;</p>

                    <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
                        {!! Form::label('interest', 'Interest') !!}
                        {!! Form::number('interest', null, ['class' => 'form-control', 'step' => '0.0001']) !!}

                        @if ($errors->has('interest'))
                            <span class="help-block">
                                <strong>{{ $errors->first('interest') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        {!! Form::submit($offer->exists ? 'Save Offer' : 'Make an Offer on this Enquiry', ['class' => 'btn btn-primary']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
