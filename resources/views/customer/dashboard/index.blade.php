@extends('layouts.customer')

@section('contentheader_title', 'Dashboard')

@section('main-content')
    <h3>Enquiries</h3>

    <!-- Enquiries -->
    <enquiries csrf_token="{{ csrf_token() }}"></enquiries>

    <h3>Depositor Profiles</h3>

    <ul>
    @foreach ($depositorProfiles as $depositorProfile)
        <li>{{ $depositorProfile->name }} | CPR: {{ $depositorProfile->pin }} | CVR: {{ $depositorProfile->vatin }} | Primary: {{ $depositorProfile->is_primary }}</li>
    @endforeach
    </ul>
@endsection
