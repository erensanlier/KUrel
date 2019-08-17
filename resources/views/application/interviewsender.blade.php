@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Interview Mail Sender</div>

                    <form action="/interview" enctype="multipart/form-data" method="post">

                        @csrf
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group row" style="margin-top: 25px">

                                    <label for="email" class="col-md-4 col-form-label">{{ __("Student's KU E-Mail") }}</label>
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

                                <div class="form-group row" style="margin-top: 25px">

                                    <label for="name" class="col-md-4 col-form-label">{{ __('Student First Name') }}</label>
                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-4">
                                    <button class="btn btn-primary" style="margin-bottom: 25px">Send Mail</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>



    </div>
@endsection
