@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Request {{ $request->id }}</div>
                    <div class="row d-inline p-5">
                        <div class="row"><strong class="pr-1">Request ID: </strong> {{ $request->id }}</div>
                        <div class="row"><strong class="pr-1">Student E-Mail: </strong> {{ $request->email }}</div>
                        <div class="row"><strong class="pr-1">Course: </strong> {{ $request->course }}</div>
                        <div class="row"><strong class="pr-1">Reason: </strong> {{ $request->reason }}</div>
                        <div class="row"><strong class="pr-1">Time: </strong> {{ $request->startTime }}</div>
                        <div class="row"><strong class="pr-1">Notes: </strong> {{ $request->notes }}</div>
                        <div class="row"><strong class="pr-1">Taken By: </strong> {{ $request->taken_by ?? 'No one yet' }}</div>
                        <div class="row"><strong class="pr-1">Taken Place: </strong> {{ $request->taken_place ? 'Yes':'No'}}</div>
                        <div class="row"><strong class="pr-1">Created At: </strong> {{ $request->created_at }}</div>
                        <div class="row"><strong class="pr-1">Updated At: </strong> {{ $request->updated_at }}</div>
                        <div class="row justify-content-end">
                            @if(!$request->taken_place)
                                <button onclick="window.location.href = '/request/{{ $request->id }}/done'" class="btn btn-primary" style="margin: 3px">Done</button>
                            @endif
                            @if($request->taken_by == auth()->user()->name)
                            <button onclick="window.location.href = '/request/{{ $request->id }}/take'" class="btn btn-primary" style="margin: 3px">Take</button>
                            @endif
                            @can('update', $request)
                                <button onclick="window.location.href = '/request/{{ $request->id }}/edit'" class="btn btn-primary" style="margin: 3px">Edit</button>
                            @endcan
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
@endsection