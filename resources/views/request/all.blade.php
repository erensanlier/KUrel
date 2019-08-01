@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Select a SL</div>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin: 20px">
                    <option>Select a SL...</option>
                    @foreach(\App\User::all() as $user)
                        <option value="/appointments/{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="card" style="margin-top: 20px">
                <div class="card-header">All Requests</div>
                @foreach($requests as $request)
                    <div class="border-bottom p-5">
                        <div>
                            <div class="row"><strong class="pr-1"><nbsp></nbsp>Student E-Mail: </strong> {{ $request->email }}</div>
                            <div class="row"><strong class="pr-1">Course: </strong> {{ $request->course }}</div>
                            <div class="row"><strong class="pr-1">Reason: </strong> {{ $request->reason }}</div>
                            <div class="row"><strong class="pr-1">Time: </strong> {{ $request->startTime }}</div>
                            <div class="row"><strong class="pr-1">Notes: </strong> {{ $request->notes }}</div>
                            <div class="row"><strong class="pr-1">Taken By: </strong> {{ $request->taken_by ?? 'No one yet!' }}</div>
                            <div class="row"><strong class="pr-1">Taken Place: </strong> {{ $request->taken_place ? 'Yes' : 'No' }}</div>
                        </div>
                        <div class="row justify-content-lg-end">
                            @if(!$request->taken_place)
                                <button onclick="window.location.href = '/request/{{ $request->id }}/done'" class="btn btn-primary" style="margin: 3px">Done</button>
                            @endif
                            <button onclick="window.location.href = '/request/{{ $request->id }}'" class="btn btn-primary" style="margin: 3px">Details</button>
                            @if(!$request->taken_by == auth()->user()->name)
                                <button onclick="window.location.href = '/request/{{ $request->id }}/take'" class="btn btn-primary" style="margin: 3px">Take</button>
                            @endif
                            @can('update', $request)
                                <button onclick="window.location.href = '/request/{{ $request->id }}/edit'" class="btn btn-primary" style="margin: 3px">Edit</button>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
