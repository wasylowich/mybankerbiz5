@extends('layouts.app')

@section('contentheader_title', 'Currencies')

@section('main-content')

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a href="{{ route('admin.currencies.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add Currency</a>
        </div>

        <div class="box-body">

            <table id="crudTable" class="table table-bordered table-striped display dataTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Precision</th>
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
                            <td>
                            @unless ($currency->deleted_at)
                                <a href="{{ route('admin.currencies.edit', $currency->id) }}" class="btn btn-xs btn-default">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('admin.currencies.destroy', $currency->id) }}" class="btn btn-xs btn-default" data-button-type="delete">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
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
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
@endsection
