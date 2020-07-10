@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 25px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">To create a new appointment request</div>
                    <div class="row col-8 offset-1" style="margin-top: 25px">1. Fill in the form. You can make appointments the day before.</div>
                    <div class="row col-8 offset-1">2. Verify your request through the email sent to you. The request will expire after 15 minutes.</div>
                    <div class="row col-8 offset-1">3. Wait until an available SL is assigned to your request, you will receive an email.</div>
                    <div class="row col-8 offset-1">4. Come to the office at the selected time.</div>
                    <div class="row col-8 offset-1" style="margin-bottom: 25px">5. If you encounter any problems, please contact us!</div>
                    <div class="row col-8 offset-1" style="margin-bottom: 25px">If no SL takes your appointment, you can reschedule it simply by creating a new request.</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Request for {{\Carbon\Carbon::tomorrow()->format("l")}} (tomorrow)</div>

                    <form action="/request" enctype="multipart/form-data" method="post">

                        @csrf
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group row" style="margin-top: 25px">

                                    <label for="course" class="col-md-4 col-form-label">{{ __('Course') }}</label>
                                    <select id="course"
                                            type="text"
                                            class="form-control @error('course') is-invalid @enderror"
                                            name="course"
                                            value="{{ old('course') }}" required autocomplete="course" autofocus
                                            onchange="updateTime()">
                                        <option>UNIV198</option>
                                        <option selected>COMP125</option>
                                        <option>COMP131</option>
                                    </select>

                                    @error('course')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
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

<script>
    updateTime();
    function updateTime() {
        var e = document.getElementById("course");
        var course = e.options[e.selectedIndex].text;
        var example_array;
        var select;
        var date = new Date(Date.now());

        if(course === "COMP125" || course === "UNIV198"){
            document.getElementById("startTime").length = 0;
            if(date.getDay() === 7){
                example_array = {
                    ValueA : '10:00',
                    ValueB : '10:15',
                    ValueC : '10:30',
                    ValueD : '10:45',
                    ValueE : '11:00',
                    ValueF : '11:30',
                    ValueG : '11:45',
                    ValueH : '12:00',
                    ValueI : '12:15',
                    ValueJ : '12:30',
                    ValueK : '16:00',
                    ValueL : '16:15',
                    ValueM : '16:30',
                    ValueN : '16:45',
                    ValueO : '17:00',
                    ValueP : '17:30',
                    ValueR : '17:45',
                    ValueS : '18:00',
                    ValueT : '18:15',
                    ValueU : '18:30'
                };
            }
            if(date.getDay() === 1){
                example_array = {
                    ValueA : '10:00',
                    ValueB : '10:15',
                    ValueC : '10:30',
                    ValueD : '10:45',
                    ValueE : '11:00',
                    ValueF : '11:30',
                    ValueG : '11:45',
                    ValueH : '12:00',
                    ValueI : '12:15',
                    ValueJ : '12:30',
                    ValueP : '13:00',
                    ValueR : '13:15',
                    ValueS : '13:30',
                    ValueT : '13:45',
                    ValueU : '14:00',
                    ValueK : '16:00',
                    ValueL : '16:15',
                    ValueM : '16:30',
                    ValueN : '16:45',
                    ValueO : '17:00'
                };
            }
            if(date.getDay() === 2){
                example_array = {
                    ValueA : '10:00',
                    ValueB : '10:15',
                    ValueC : '10:30',
                    ValueD : '10:45',
                    ValueE : '11:00',
                    ValueF : '11:30',
                    ValueG : '11:45',
                    ValueH : '12:00',
                    ValueI : '12:15',
                    ValueJ : '12:30',
                    ValueP : '14:30',
                    ValueR : '14:45',
                    ValueS : '15:00',
                    ValueT : '15:15',
                    ValueU : '15:30',
                    ValueK : '16:00',
                    ValueL : '16:15',
                    ValueM : '16:30',
                    ValueN : '16:45',
                    ValueO : '17:00',
                };
            }
            if(date.getDay() === 3){
                example_array = {
                    ValueA : '10:00',
                    ValueB : '10:15',
                    ValueC : '10:30',
                    ValueD : '10:45',
                    ValueE : '11:00',
                    ValueF : '11:30',
                    ValueG : '11:45',
                    ValueH : '12:00',
                    ValueI : '12:15',
                    ValueJ : '12:30',
                    ValueP : '13:00',
                    ValueR : '13:15',
                    ValueS : '13:30',
                    ValueT : '13:45',
                    ValueU : '14:00',
                    ValueZ : '14:30',
                    ValueY : '14:45',
                    ValueX : '15:00',
                    ValueW : '15:15',
                    ValueV : '15:30',
                    ValueK : '16:00',
                    ValueL : '16:15',
                    ValueM : '16:30',
                    ValueN : '16:45',
                    ValueO : '17:00',
                    ValueAA : '17:30',
                    ValueAB : '17:45',
                    ValueAC : '18:00',
                    ValueAD : '18:15',
                    ValueAE : '18:30'
                };
            }
            if(date.getDay() === 4){
                example_array = {
                    ValueF : '11:30',
                    ValueG : '11:45',
                    ValueH : '12:00',
                    ValueI : '12:15',
                    ValueJ : '12:30',
                    ValueP : '14:30',
                    ValueR : '14:45',
                    ValueS : '15:00',
                    ValueT : '15:15',
                    ValueU : '15:30',
                    ValueK : '16:00',
                    ValueL : '16:15',
                    ValueM : '16:30',
                    ValueN : '16:45',
                    ValueO : '17:00',
                };
            }

            select = document.getElementById("startTime");
            for(index in example_array) {
                select.options[select.options.length] = new Option(example_array[index], index);
            }
        }
        else if(course === "COMP131"){
            document.getElementById("startTime").length = 0;
            if(date.getDay() === 7 || date.getDay() === 1){
                example_array = {
                    ValueA : '13:00',
                    ValueB : '13:15',
                    ValueC : '13:30',
                    ValueD : '13:45',
                    ValueE : '14:00',
                    ValueF : '14:30',
                    ValueG : '14:45',
                    ValueH : '15:00',
                    ValueI : '15:15',
                    ValueJ : '15:30',
                };
            }
            if(date.getDay() === 2){
                example_array = {
                    ValueF : '14:30',
                    ValueG : '14:45',
                    ValueH : '15:00',
                    ValueI : '15:15',
                    ValueJ : '15:30',
                    ValueA : '16:00',
                    ValueB : '16:15',
                    ValueC : '16:30',
                    ValueD : '16:45',
                    ValueE : '17:00',
                };
            }
            if(date.getDay() === 3){
                example_array = {
                    ValueF : '14:30',
                    ValueG : '14:45',
                    ValueH : '15:00',
                    ValueI : '15:15',
                    ValueJ : '15:30',
                };
            }
            if(date.getDay() === 4){
                example_array = {
                    ValueF : '13:00',
                    ValueG : '13:15',
                    ValueH : '13:30',
                    ValueI : '13:45',
                    ValueJ : '14:00',
                    ValueA : '16:00',
                    ValueB : '16:15',
                    ValueC : '16:30',
                    ValueD : '16:45',
                    ValueE : '17:00',
                };
            }

            select = document.getElementById("startTime");
            for(index in example_array) {
                select.options[select.options.length] = new Option(example_array[index], index);
            }
        }

    }
</script>
@endsection
