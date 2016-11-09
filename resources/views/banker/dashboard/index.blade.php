@extends('layouts.banker')

@section('contentheader_title', 'Banker Dashboard')

@section('main-content')
    <h1>Banker Dashboard for {{ Auth::user()->name }}</h1>

    <p>Boilerplate text for the banker's dashboard</p>
@endsection
