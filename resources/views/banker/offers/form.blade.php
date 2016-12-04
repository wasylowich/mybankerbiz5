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
                    <legend>Enquiry Information</legend>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6"><strong>Enquiry</strong></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">{{ $offerChance->enquiry->depositType->name }}</div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">Amount</div>
                                <div class="col-sm-6">{{ $offerChance->enquiry->amount }} {{ $offerChance->enquiry->currency->code }}</div>
                            </div>
                            @if ($offerChance->enquiry->depositType->name == 'period')
                            <div class="row">
                                <div class="col-sm-6">Period From</div>
                                <div class="col-sm-6">{{ $offerChance->enquiry->fixation_period_start_date }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">Period To</div>
                                <div class="col-sm-6">{{ $offerChance->enquiry->fixation_period_end_date }}</div>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6"><strong>Enquirer</strong></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">{{ $offerChance->enquiry->depositorProfile->depositorType->name }}</div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">TODO: PostalCode City</div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">TODO: Country</div>
                                <div class="col-sm-6"></div>
                            </div>
                        </div>
                    </div>

                    <!-- TODO: Use CSS to add vertical space between bootstrap rows when needed -->
                    <h1></h1>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6"><strong>Commission</strong></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">Rate</div>
                                <div class="col-sm-6">TODO: rate % pro anno</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">Amount (ex moms)</div>
                                <div class="col-sm-6">TODO: The commission amount (Fx. 1.600 DKK)</div>
                            </div>
                            @if ($offerChance->enquiry->depositType->name == 'pension')
                            <div class="row">
                                <div class="col-sm-12">TODO: Kommissionen er vist for 1 år. Den ganges op med den tilbudte bindingsperiode.</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- TODO: Use CSS to add vertical space between bootstrap rows when needed -->
            <h1></h1>

            <div class="box-body row">
                <fieldset class="col-sm-12">
                    <legend>Your Offer</legend>

                    <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
                        {!! Form::label('interest', 'Annual Interest') !!}
                        {!! Form::number('interest', null, ['class' => 'form-control', 'step' => '0.0001']) !!}

                        @if ($errors->has('interest'))
                            <span class="help-block">
                                <strong>{{ $errors->first('interest') }}</strong>
                            </span>
                        @endif
                    </div>

                    @if ($offerChance->enquiry->depositType->name == 'pension')
                    <div class="form-group{{ $errors->has('fixation_period_months') ? ' has-error' : '' }}">
                        {!! Form::label('fixation_period_months', 'FixationPeriod') !!}
                        {!! Form::select(
                                'fixation_period_months',
                                [0 => 'Variable', 6 => '6 months', 12 => '1 year', 24 => '2 years', 36 => '3 years', 48 => '4 years', 60 => '5 years'],
                                null,
                                array(
                                    'placeholder' => 'Select a FixationPeriod',
                                    'class'       => 'form-control'
                                )
                            ) !!}

                        @if ($errors->has('fixation_period_months'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fixation_period_months') }}</strong>
                            </span>
                        @endif
                    </div>
                    @endif

                    <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                        {!! Form::label('deadline', 'OfferDeadline') !!}
                        {!! Form::input('date', 'deadline', Carbon\Carbon::now()->addDays(2)->format('Y-m-d'), ['class' => 'form-control']) !!}

                        @if ($errors->has('deadline'))
                            <span class="help-block">
                                <strong>{{ $errors->first('deadline') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-sm-12"><strong>Enquiry ID:</strong> {{ $offerChance->enquiry->id }}</div>

                    <p>&nbsp;</p>

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
