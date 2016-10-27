@extends('layouts.app')

@section('contentheader_title', 'InterestTerms')

@section('main-content')

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.interestTerms.create') }}" class="btn btn-primary"><i class='fa fa-plus'></i>  Add InterestTerm</a>
    </div>

    <div class="box-body">
        <table id="crudTable" class="table table-bordered table-striped display dataTable">
            <thead>
                <tr>
                    <th>Term</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($interestTerms as $interestTerm)
                <tr data-entry-id="{{ $interestTerm->id }}">
                        <td>
                        @if ($interestTerm->deleted_at)
                            {{ $interestTerm->term }}
                        @else
                            <a href="{{ route('admin.interestTerms.edit', $interestTerm->id) }}">{{ $interestTerm->term }}</a>
                        @endif
                        </td>
                        <td>
                        @unless ($interestTerm->deleted_at)
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.interestTerms.destroy', $interestTerm->id], 'class' => 'form-inline']) !!}
                                <!-- The edit button -->
                                <a href="{{ route('admin.interestTerms.edit', $interestTerm->id) }}" class="btn btn-xs btn-default">
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
                    <th>Term</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
