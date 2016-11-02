@extends('layouts.app')

@section('contentheader_title', 'Memberships')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.memberships.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add Membership</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($memberships as $membership)
                <tr data-entry-id="{{ $membership->id }}">
                        <td>
                        @if ($membership->deleted_at)
                            {{ $membership->name }}
                        @else
                            <a href="{{ route('admin.memberships.edit', $membership->id) }}">{{ $membership->name }}</a>
                        @endif
                        </td>
                        <td>
                        @unless ($membership->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.memberships.destroy', $membership->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.memberships.edit', $membership->id) }}" class="btn btn-xs btn-default">
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
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
