@extends('layouts.customer')

@section('contentheader_title', 'Offers')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-body">
        <h3>Active Offers</h3>
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
                @if ($offer->state == 'active')
                <tr data-entry-id="{{ $offer->id }}">
                    <td>{{ $offer->bank->name }}</td>
                    <td>{{ $offer->enquiry->amount }}</td>
                    <td>{{ $offer->interest }}</td>
                    <td>{{ round($offer->amount, $offer->enquiry->currency->precision) }}</td>
                    <td>
                    @if ($offer->enquiry->depositType->name === 'pension')
                        pension
                    @else
                        {{ $offer->enquiry->fixation_period }} days
                    @endif
                    </td>
                    <td>{{ $offer->state }}</td>
                    <td>
                    @unless ($offer->deleted_at)
                        {!! Form::open(['method' => 'post', 'route' => ['customer.offers.reject', $offer->id], 'class' => 'form-inline']) !!}
                            <!-- The accept button -->
                            <a href="{{ route('customer.offers.accept', ['offer' => $offer->id]) }}" class="btn btn-xs btn-default">
                                <i class="fa fa-create"></i> Accept
                            </a>
                            <!-- The reject button (submits the form) -->
                            {!! Form::button('<i class="fa fa-trash"></i> Reject', array('type' => 'submit', 'class' => 'btn btn-xs btn-danger')) !!}

                        {!! Form::close() !!}
                    @endunless
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

        <p>&nbsp;</p>

        <h3>Accepted Offers</h3>
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
                @if ($offer->state == 'accepted')
                <tr data-entry-id="{{ $offer->id }}">
                    <td>{{ $offer->bank->name }}</td>
                    <td>{{ $offer->enquiry->amount }}</td>
                    <td>{{ $offer->interest }}</td>
                    <td>{{ round($offer->amount, $offer->enquiry->currency->precision) }}</td>
                    <td>
                    @if ($offer->enquiry->depositType->name === 'pension')
                        pension
                    @else
                        {{ $offer->enquiry->fixation_period }} days
                    @endif
                    </td>
                    <td>{{ $offer->state }}</td>
                    <td></td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

        <p>&nbsp;</p>

        <h3>Rejected Offers</h3>
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
                @if ($offer->state == 'rejected')
                <tr data-entry-id="{{ $offer->id }}">
                    <td>{{ $offer->bank->name }}</td>
                    <td>{{ $offer->enquiry->amount }}</td>
                    <td>{{ $offer->interest }}</td>
                    <td>{{ round($offer->amount, $offer->enquiry->currency->precision) }}</td>
                    <td>
                    @if ($offer->enquiry->depositType->name === 'pension')
                        pension
                    @else
                        {{ $offer->enquiry->fixation_period }} days
                    @endif
                    </td>
                    <td>{{ $offer->state }}</td>
                    <td></td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
