@extends('layouts.app')

@section('contentheader_title', 'Roles')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i> Add Role</a>
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
                @foreach($roles as $role)
                <tr data-entry-id="{{ $role->id }}">
                        <td>
                        @if ($role->deleted_at)
                            {{ $role->name }}
                        @else
                            <a href="{{ route('admin.roles.edit', $role->id) }}">{{ $role->name }}</a>
                        @endif
                        </td>
                        <td>{{ implode(', ', $role->permissions->pluck('name')->all()) }}</td>
                        <td>
                        @unless ($role->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.roles.destroy', $role->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-xs btn-default">
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
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
