@extends('layouts.banker')

@section('contentheader_title', 'Offers')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('banker.offers.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add Offer</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
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
                    <td>
                    @unless ($offer->deleted_at)
                        {!! Form::open(['method' => 'post', 'route' => ['banker.offers.cancel', $offer->id], 'class' => 'form-inline']) !!}
                            <!-- The cancel button (submits the form) -->
                            {!! Form::button('<i class="fa fa-trash"></i> Cancel', array('type' => 'submit', 'class' => 'btn btn-xs btn-danger')) !!}

                        {!! Form::close() !!}
                    @endunless
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Bank</th>
                    <th>Investment Amount</th>
                    <th>Interest</th>
                    <th>Total Earnings</th>
                    <th>FixationPeriod</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
