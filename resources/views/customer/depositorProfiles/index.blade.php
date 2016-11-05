@extends('layouts.customer')

@section('contentheader_title', 'DepositorProfiles')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('customer.depositorProfiles.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add DepositorProfile</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>CVR</th>
                    <th>CPR</th>
                    <th>Primary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($depositorProfiles as $depositorProfile)
                <tr data-entry-id="{{ $depositorProfile->id }}">
                    <td>
                    @if ($depositorProfile->deleted_at)
                        {{ $depositorProfile->name }}
                    @else
                        <a href="{{ route('customer.depositorProfiles.edit', $depositorProfile->id) }}">{{ $depositorProfile->name }}</a>
                    @endif
                    </td>
                    <td>{{ $depositorProfile->vatin }}</td>
                    <td>{{ $depositorProfile->pin }}</td>
                    <td>{{ $depositorProfile->status }}</td>
                    <td>{{ $depositorProfile->primary }}</td>
                    <td>
                    @unless ($depositorProfile->deleted_at)
                        {!! Form::open(['method' => 'delete', 'route' => ['customer.depositorProfiles.destroy', $depositorProfile->id], 'class' => 'form-inline']) !!}
                            <!-- The edit button -->
                            <a href="{{ route('customer.depositorProfiles.edit', $depositorProfile->id) }}" class="btn btn-xs btn-default">
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
                    <th>Name</th>
                    <th>CVR</th>
                    <th>CPR</th>
                    <th>Primary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
