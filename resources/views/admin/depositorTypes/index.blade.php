@extends('layouts.app')

@section('contentheader_title', 'DepositorTypes')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.depositorTypes.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add DepositorType</a>
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
                @foreach($depositorTypes as $depositorType)
                <tr data-entry-id="{{ $depositorType->id }}">
                        <td>
                        @if ($depositorType->deleted_at)
                            {{ $depositorType->name }}
                        @else
                            <a href="{{ route('admin.depositorTypes.edit', $depositorType->id) }}">{{ $depositorType->name }}</a>
                        @endif
                        </td>
                        <td>
                        @unless ($depositorType->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.depositorTypes.destroy', $depositorType->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.depositorTypes.edit', $depositorType->id) }}" class="btn btn-xs btn-default">
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
