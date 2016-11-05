@extends('layouts.customer')

@section('contentheader_title', 'Dashboard')

@section('main-content')
    <h1>Dashboard for {{ Auth::user()->name }}</h1>

    <p>Boilerplate text for the customer's dashboard</p>

    <h3>Depositor Profiles</h3>

    <ul>
    @foreach ($depositorProfiles as $depositorProfile)
        <li>{{ $depositorProfile->name }} | CPR: {{ $depositorProfile->pin }} | CVR: {{ $depositorProfile->vatin }} | Primary: {{ $depositorProfile->is_primary }}</li>
    @endforeach
    </ul>
@endsection
