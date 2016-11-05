@extends('layouts.depositor')

@section('contentheader_title', 'Dashboard')

@section('main-content')
    <h1>Dashboard for {{ Auth::user()->name }}</h1>

    <p>Boilerplate text for the depositor's dashboard</p>
@endsection
