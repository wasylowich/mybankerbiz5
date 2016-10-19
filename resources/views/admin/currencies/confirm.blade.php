@extends('layouts.app')

@section('title', 'Delete ' . $currency->name)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.currencies.destroy', $currency->id]]) !!}
        <div class="alert alert-danger">
            <strong>Warning!</strong> You are about to delete a currency. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this currency!', ['class' => 'btn btn-danger']) !!}

        <a href="{{ route('admin.currencies.index') }}" class="btn btn-success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
