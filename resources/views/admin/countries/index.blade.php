@extends('layouts.app')

@section('contentheader_title', 'Countries')

@section('main-content')

<!-- Default box -->
<div class="box">
    @if ($path == "admin/countries/disabled")
        <div class="box-header with-border">
            <a href="{{ route('admin.countries.index') }}" class="btn btn-primary"><i class='fa fa-eye'></i> View all Enabled Countries</a>
        </div>
    @else
        <div class="box-header with-border">
            <a href="{{ route('admin.countries.disabled') }}" class="btn btn-primary"><i class='fa fa-eye'></i> View all Disabled Countries</a>
        </div>
    @endif

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>DefaultCurrency</th>
                    <th>LocalShortForm</th>
                    <th>Abbreviation</th>
                    <th>ISOAlpha2</th>
                    <th>ISOAlpha3</th>
                    <th>TelephoneCode</th>
                    <th>TLD</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr data-entry-id="{{ $country->id }}">
                        <td>
                        @if ($country->deleted_at)
                            {{ $country->name }}
                        @else
                            <a href="{{ route('admin.countries.edit', $country->id) }}">{{ $country->name }}</a>
                        @endif
                        </td>
                        <td>{{ $country->defaultCurrency->name }}</td>
                        <td>{{ $country->local_short_form }}</td>
                        <td>{{ $country->abbreviation }}</td>
                        <td>{{ $country->iso_alpha_2 }}</td>
                        <td>{{ $country->iso_alpha_3 }}</td>
                        <td>{{ $country->telephone_code }}</td>
                        <td>{{ $country->tld }}</td>
                        <td>{{ $country->status }}</td>
                        <td>
                        @unless ($country->deleted_at)
                            {!! Form::open(['method' => 'post', 'route' => ['admin.countries.toggleEnabled', $country->id], 'class' => 'form-inline']) !!}
                                @if (!$country->is_enabled)
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
                    <th>DefaultCurrency</th>
                    <th>LocalShortForm</th>
                    <th>Abbreviation</th>
                    <th>ISOAlpha2</th>
                    <th>ISOAlpha3</th>
                    <th>TelephoneCode</th>
                    <th>TLD</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
