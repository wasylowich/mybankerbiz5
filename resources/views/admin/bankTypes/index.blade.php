@extends('layouts.app')

@section('contentheader_title', 'BankTypes')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.bankTypes.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add BankType</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bankTypes as $bankType)
                <tr data-entry-id="{{ $bankType->id }}">
                        <td>
                        @if ($bankType->deleted_at)
                            {{ $bankType->type }}
                        @else
                            <a href="{{ route('admin.bankTypes.edit', $bankType->id) }}">{{ $bankType->type }}</a>
                        @endif
                        </td>
                        <td>
                        @unless ($bankType->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.bankTypes.destroy', $bankType->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.bankTypes.edit', $bankType->id) }}" class="btn btn-xs btn-default">
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
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
