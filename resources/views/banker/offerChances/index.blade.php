@extends('layouts.banker')

@section('contentheader_title', 'OfferChances')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>BiddingExpiryDate</th>
                    <th>Amount</th>
                    <th>FixationPeriod</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offerChances as $offerChance)
                <tr data-entry-id="{{ $offerChance->id }}">
                    <td>{{ $offerChance->enquiry->bidding_deadline }} ({{ $offerChance->enquiry->bidding_deadline->diffForHumans() }})</td>
                    <td>{{ $offerChance->enquiry->amount }}</td>
                    <td>
                    @if ($offerChance->enquiry->depositType->name === 'pension')
                        pension
                    @else
                        {{ $offerChance->enquiry->fixation_period }} days
                    @endif
                    </td>
                    <td>
                    @unless ($offerChance->deleted_at)
                        {!! Form::open(['method' => 'post', 'route' => ['banker.offerChances.decline', $offerChance->id], 'class' => 'form-inline']) !!}
                            <!-- The offer button -->
                            <a href="{{ route('banker.offers.create', ['offerChance' => $offerChance->id]) }}" class="btn btn-xs btn-default">
                                <i class="fa fa-create"></i> Make Offer
                            </a>
                            <!-- The reject button (submits the form) -->
                            {!! Form::button('<i class="fa fa-trash"></i> Decline', array('type' => 'submit', 'class' => 'btn btn-xs btn-danger')) !!}

                        {!! Form::close() !!}
                    @endunless
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>BiddingExpiryDate</th>
                    <th>Amount</th>
                    <th>FixationPeriod</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
