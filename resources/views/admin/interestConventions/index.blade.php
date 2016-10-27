@extends('layouts.app')

@section('contentheader_title', 'InterestConventions')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.interestConventions.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add InterestConvention</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Convention</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($interestConventions as $interestConvention)
                <tr data-entry-id="{{ $interestConvention->id }}">
                        <td>
                        @if ($interestConvention->deleted_at)
                            {{ $interestConvention->convention }}
                        @else
                            <a href="{{ route('admin.interestConventions.edit', $interestConvention->id) }}">{{ $interestConvention->convention }}</a>
                        @endif
                        </td>
                        <td>
                        @unless ($interestConvention->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.interestConventions.destroy', $interestConvention->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.interestConventions.edit', $interestConvention->id) }}" class="btn btn-xs btn-default">
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
                    <th>Convention</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
