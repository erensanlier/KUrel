@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="/request/{{ $request->id }}" enctype="multipart/form-data" method="post">

            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row" style="color: #333333"><h1>Edit Request</h1></div>
                    <div class="form-group row">

                        <label for="email" class="col-md-4 col-form-label">{{ __(' KU E-Mail') }}</label>
                        <input id="email"
                               type="text"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') ?? $request->email }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label for="course" class="col-md-4 col-form-label">Course (originally {{ $request->course}})</label>
                        <select id="course"
                                type="text"
                                class="form-control @error('course') is-invalid @enderror"
                                name="course"
                                value="{{ old('course')}}" required autocomplete="course" autofocus>
                            <option>COMP111</option>
                            <option>COMP130</option>
                            <option>COMP131</option>
                            <option>None</option>
                        </select>

                        @error('course')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label for="reason" class="col-md col-form-label">Reason (originally {{ $request->reason }})</label>
                        <select id="reason"
                                type="text"
                                class="form-control @error('reason') is-invalid @enderror"
                                name="reason"
                                value="{{ old('reason')}}" required autocomplete="reason" autofocus>
                            <option>Course Related Help</option>
                            <option>Technical Help</option>
                            <option>Feedback Session</option>
                            <option>Just to chat</option>
                            <option>Other..(please specify in the notes)</option>
                        </select>

                        @error('reason')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label for="startTime" class="col-md-4 col-form-label">{{ __('Time') }}</label>
                        <input id="startTime"
                               type="time"
                               class="form-control @error('startTime') is-invalid @enderror"
                               name="startTime"
                               value="{{ old('startTime') ?? $request->startTime}}" required autocomplete="startTime" autofocus>

                        @error('startTime')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label for="notes" class="col-md-4 col-form-label">{{ __('Notes') }}</label>
                        <input id="notes"
                               type="text"
                               class="form-control @error('notes') is-invalid @enderror"
                               name="notes"
                               value="{{ old('notes') ?? $request->notes}}" autocomplete="notes" autofocus>

                        @error('notes')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label for="taken_by" class="col-md-4 col-form-label">Taken By</label>
                        <select id="taken_by"
                                type="text"
                                class="form-control @error('taken_by') is-invalid @enderror"
                                name="taken_by"
                                value="{{ old('taken_by') ?? $request->taken_by}}" required autocomplete="taken_by" autofocus>
                            <option>{{ old('taken_by') ?? $request->taken_by}}</option>
                            @foreach(\App\User::all() as $user)
                                @if($request->taken_by != $user->name)
                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                            @if($request->taken_by != null)
                                <option value="">...</option>
                            @endif
                        </select>
                        @error('taken_by')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row pt-4">
                        <button class="btn btn-primary">Save Request</button>
                    </div>
                </div>
            </div>
        </form>


        <div class="row">
            @if(!$request->taken_place)
                <button onclick="window.location.href = '/request/{{ $request->id }}/done'" class="btn btn-primary offset-2">Mark as Done</button>
            @else
                <button onclick="window.location.href = '/request/{{ $request->id }}/undone'" class="btn btn-primary offset-2">Mark as Undone</button>
            @endif
        </div>

        <div class="row" style="margin-top: 15px">
            <button onclick="window.location.href = '/request/{{ $request->id }}/delete'" class="btn btn-primary offset-2">Delete Request</button>
        </div>

    </div>
@endsection
