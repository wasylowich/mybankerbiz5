@extends('layouts.app')

@section('contentheader_title', 'Banks')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.banks.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add Bank</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Name</th>
                    <th>CVR</th>
                    <th>Website</th>
                    <th>BankType</th>
                    <th>InterestConvention</th>
                    <th>InterestTerm</th>
                    <th>PensionInterestConvention</th>
                    <th>RebateType</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banks as $bank)
                <tr data-entry-id="{{ $bank->id }}">
                    <td>{{ $bank->country->name }}</td>
                    <td>
                    @if ($bank->deleted_at)
                        {{ $bank->name }}
                    @else
                        <a href="{{ route('admin.banks.edit', $bank->id) }}">{{ $bank->name }}</a>
                    @endif
                    </td>
                    <td>{{ $bank->vatin }}</td>
                    <td>{{ $bank->website }}</td>
                    <td>{{ $bank->bankType->type }}</td>
                    <td>{{ $bank->interestConvention->convention }}</td>
                    <td>{{ $bank->interestTerm->term }}</td>
                    <td>{{ $bank->pensionInterestConvention->convention }}</td>
                    <td>{{ $bank->rebateType->type }}</td>
                    <td>{{ $bank->status }}</td>
                    <td>
                    @unless ($bank->deleted_at)
                        {!! Form::open(['method' => 'delete', 'route' => ['admin.banks.destroy', $bank->id], 'class' => 'form-inline']) !!}
                            <!-- The edit button -->
                            <a href="{{ route('admin.banks.edit', $bank->id) }}" class="btn btn-xs btn-default">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <!-- The delete button (submits the form) -->
                            {!! Form::button('<i class="fa fa-trash"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-xs btn-danger')) !!}

                        {!! Form::close() !!}
                    @endunless
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Country</th>
                    <th>Name</th>
                    <th>CVR</th>
                    <th>Website</th>
                    <th>BankType</th>
                    <th>InterestConvention</th>
                    <th>InterestTerm</th>
                    <th>PensionInterestConvention</th>
                    <th>RebateType</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
