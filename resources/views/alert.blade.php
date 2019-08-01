@extends('layouts.app')

@section('content')

    @if($type == 'success')
    <div class="alert alert-success text-center" role="alert">
        <strong>Well done!</strong> {{$msg}}.
    </div>
    @elseif($type == 'info')
    <div class="alert alert-info text-center" role="alert">
        <strong>Heads up!</strong> {{$msg}}.
    </div>
    @elseif($type == 'warning')
    <div class="alert alert-warning text-center" role="alert">
        <strong>Warning!</strong> {{$msg}}.
    </div>
    @elseif($type == 'danger')
    <div class="alert alert-danger text-center" role="alert">
        <strong>Oh snap!</strong> {{$msg}}.
    </div>
    @endif

@endsection