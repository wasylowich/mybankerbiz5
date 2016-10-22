@extends('layouts.app')

@section('contentheader_title', 'Users')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i> Add User</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                        <td>
                        @if ($user->deleted_at)
                            {{ $user->name }}
                        @else
                            <a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a>
                        @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(', ', $user->roles->pluck('name')->all()) }}</td>
                        <td>
                        @unless ($user->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.users.destroy', $user->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-xs btn-default">
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
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
