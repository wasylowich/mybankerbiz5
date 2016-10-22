@extends('layouts.app')

@section('contentheader_title', 'Permissions')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i> Add Permission</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr data-entry-id="{{ $permission->id }}">
                        <td>
                        @if ($permission->deleted_at)
                            {{ $permission->name }}
                        @else
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}">{{ $permission->name }}</a>
                        @endif
                        </td>
                        <td>{{ implode(', ', $permission->roles->pluck('name')->all()) }}</td>
                        <td>
                        @unless ($permission->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.permissions.destroy', $permission->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-xs btn-default">
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
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
