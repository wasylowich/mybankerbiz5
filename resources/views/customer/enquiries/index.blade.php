@extends('layouts.customer')

@section('contentheader_title', 'Enquiries')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('customer.enquiries.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add Enquiry</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>DepositorProfile</th>
                    <th>OffersExpiryDate</th>
                    <th>Amount</th>
                    <th>FixationPeriod</th>
                    <th>Offers</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $enquiry)
                <tr data-entry-id="{{ $enquiry->id }}">
                    <td>{{ $enquiry->depositorProfile->name }}</td>
                    <td>TODO</td>
                    <td>{{ $enquiry->amount }}</td>
                    <td>
                    @if ($enquiry->depositType->name === 'pension')
                        pension
                    @else
                        {{ $enquiry->fixation_period }} days
                    @endif
                    </td>
                    <td>TODO</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>DepositorProfile</th>
                    <th>OffersExpiryDate</th>
                    <th>Amount</th>
                    <th>FixationPeriod</th>
                    <th>Offers</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
