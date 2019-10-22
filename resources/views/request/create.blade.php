@extends('layouts.app')

@section('content')

<?php
use Carbon\Carbon;

?>

    <div class="container">

        <div class="row justify-content-center" style="margin-bottom: 25px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">To create a new appointment request</div>

                    <div class="row col-8 offset-1" style="margin-top: 25px">1. Fill in the form.</div>
                    <div class="row col-8 offset-1">2. Verify your request through the email sent to you. The request will expire after 15 minutes.</div>
                    <div class="row col-8 offset-1">3. Wait until an available SL is assigned to your request, you will receive an email.</div>
                    <div class="row col-8 offset-1">4. Come to our office at the selected time.</div>
                    <div class="row col-8 offset-1" style="margin-bottom: 25px">5. If you encounter any problems, please contact us!</div>
                    <div class="row col-8 offset-1" style="margin-bottom: 25px">If no SL takes your appointment, you can reschedule it simply by creating a new request.</div>


                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Request</div>

                    <form action="/request" enctype="multipart/form-data" method="post">

                        @csrf
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group row" style="margin-top: 25px">

                                    <label for="email" class="col-md-4 col-form-label">{{ __('KU E-Mail') }}</label>
                                    <input id="email"
                                           type="text"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group row">

                                    <label for="course" class="col-md-4 col-form-label">{{ __('Course') }}</label>
                                    <select id="course"
                                            type="text"
                                            class="form-control @error('course') is-invalid @enderror"
                                            name="course"
                                            value="{{ old('course') }}" required autocomplete="course" autofocus>
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

                                    <label for="reason" class="col-md-4 col-form-label">{{ __('Reason') }}</label>
                                    <select id="reason"
                                            type="text"
                                            class="form-control @error('reason') is-invalid @enderror"
                                            name="reason"
                                            value="{{ old('reason') }}" required autocomplete="reason" autofocus>
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
                                    <select id="startTime"
                                           type="time"
                                           class="form-control @error('startTime') is-invalid @enderror"
                                           name="startTime"
                                           value="{{ old('startTime') }}" required autocomplete="startTime" autofocus>

                                        @for($hour = '08'; $hour < 21; $hour++)
                                            @for($minute = '00'; $minute < 60; $minute+=15)
                                                <option>{{$hour}}:{{$minute}}</option>
                                            @endfor
                                        @endfor
                                        <option>21:00</option>
                                    </select>

                                    @error('startTime')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group row">

                                    <label for="notes" class="col-md-8 col-form-label">Notes (please specify reason)</label>
                                    <input id="notes"
                                           type="text"
                                           class="form-control @error('notes') is-invalid @enderror"
                                           name="notes"
                                           value="{{ old('notes') }}" required autocomplete="notes" autofocus>

                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-4">
                                    <button class="btn btn-primary" style="margin-bottom: 25px">Create Request</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>



    </div>
@endsection
