@extends('layouts.app')

@section('contentheader_title', 'Currencies')

@section('main-content')

<!-- Default box -->
<div class="box">
    @if ($path == "admin/currencies/disabled")
        <div class="box-header with-border">
            <a href="{{ route('admin.currencies.index') }}" class="btn btn-primary"><i class='fa fa-eye'></i> View all Enabled Currencies</a>
        </div>
    @else
        <div class="box-header with-border">
            <a href="{{ route('admin.currencies.disabled') }}" class="btn btn-primary"><i class='fa fa-eye'></i> View all Disabled Currencies</a>
        </div>
    @endif

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Precision</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($currencies as $currency)
                <tr data-entry-id="{{ $currency->id }}">
                        <td>
                        @if ($currency->deleted_at)
                            {{ $currency->name }}
                        @else
                            <a href="{{ route('admin.currencies.edit', $currency->id) }}">{{ $currency->name }}</a>
                        @endif
                        </td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->precision }}</td>
                        <td>{{ $currency->status }}</td>
                        <td>
                        @unless ($currency->deleted_at)
                            {!! Form::open(['method' => 'post', 'route' => ['admin.currencies.toggleEnabled', $currency->id], 'class' => 'form-inline']) !!}
                                @if (!$currency->is_enabled)
                                    <!-- The enable button (submits the form) -->
                                    {!! Form::button('<i class="fa fa-plus"></i> Enable', array('type' => 'submit', 'class' => 'btn btn-xs btn-success')) !!}
                                @else
                                    <!-- The disable button (submits the form) -->
                                    {!! Form::button('<i class="fa fa-minus"></i> Disable', array('type' => 'submit', 'class' => 'btn btn-xs btn-danger')) !!}
                                @endif

                            {!! Form::close() !!}
                        @endunless
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Precision</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
