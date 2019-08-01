@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pending Requests</div>


                @foreach($requests as $request)
                    <div class="border-bottom p-5">
                        <div>
                            <div class="row"><strong class="pr-1">Student E-Mail: </strong> {{ $request->email }}</div>
                            <div class="row"><strong class="pr-1">Course: </strong> {{ $request->course }}</div>
                            <div class="row"><strong class="pr-1">Reason: </strong> {{ $request->reason }}</div>
                            <div class="row"><strong class="pr-1">Time: </strong> {{ $request->startTime }}</div>
                            <div class="row"><strong class="pr-1">Notes: </strong> {{ $request->notes }}</div>
                        </div>
                        <div class="row justify-content-lg-end">
                            <button onclick="window.location.href = '/request/{{ $request->id }}'" class="btn btn-primary" style="margin: 3px">Details</button>
                            <button onclick="window.location.href = '/request/{{ $request->id }}/take'" class="btn btn-primary" style="margin: 3px">Take</button>
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
