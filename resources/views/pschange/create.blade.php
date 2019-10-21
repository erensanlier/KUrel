@extends('layouts.app')

@section('content')

    <?php
    use Carbon\Carbon;

    ?>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">PS Change Request</div>

                    <form action="/pschange" enctype="multipart/form-data" method="post">

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

                                    <label for="yourPS" class="col-md-4 col-form-label">{{ __('Your PS') }}</label>
                                    <select id="yourPS"
                                            type="text"
                                            class="form-control @error('yourPS') is-invalid @enderror"
                                            name="yourPS"
                                            value="{{ old('yourPS') }}" required autocomplete="yourPS" autofocus>
                                        <option>COMP 111 - PS A</option>
                                        <option>COMP 130 - PS A</option>
                                        <option>COMP 130 - PS B</option>
                                        <option>COMP 130 - PS C</option>
                                        <option>COMP 130 - PS D</option>
                                        <option>COMP 130 - PS E</option>
                                        <option>COMP 130 - PS F</option>
                                        <option>COMP 130 - PS G</option>
                                        <option>COMP 130 - PS H</option>
                                        <option>COMP 130 - PS I</option>
                                        <option>COMP 130 - PS J</option>
                                        <option>COMP 130 - PS K</option>
                                        <option>COMP 130 - PS L</option>
                                        <option>COMP 130 - PS M</option>
                                        <option>COMP 131 - PS A</option>
                                        <option>COMP 131 - PS B</option>
                                        <option>COMP 131 - PS C</option>
                                        <option>COMP 131 - PS D</option>
                                        <option>COMP 131 - PS E</option>
                                        <option>COMP 131 - PS F</option>
                                        <option>COMP 131 - PS G</option>
                                        <option>COMP 131 - PS H</option>
                                    </select>

                                    @error('yourPS')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">

                                    <label for="desiredPS" class="col-md-4 col-form-label">{{ __('Desired PS') }}</label>
                                    <select id="desiredPS"
                                            type="text"
                                            class="form-control @error('desiredPS') is-invalid @enderror"
                                            name="desiredPS"
                                            value="{{ old('desiredPS') }}" required autocomplete="desiredPS" autofocus>
                                        <option>COMP 111 - PS A</option>
                                        <option>COMP 130 - PS A</option>
                                        <option>COMP 130 - PS B</option>
                                        <option>COMP 130 - PS C</option>
                                        <option>COMP 130 - PS D</option>
                                        <option>COMP 130 - PS E</option>
                                        <option>COMP 130 - PS F</option>
                                        <option>COMP 130 - PS G</option>
                                        <option>COMP 130 - PS H</option>
                                        <option>COMP 130 - PS I</option>
                                        <option>COMP 130 - PS J</option>
                                        <option>COMP 130 - PS K</option>
                                        <option>COMP 130 - PS L</option>
                                        <option>COMP 130 - PS M</option>
                                        <option>COMP 131 - PS A</option>
                                        <option>COMP 131 - PS B</option>
                                        <option>COMP 131 - PS C</option>
                                        <option>COMP 131 - PS D</option>
                                        <option>COMP 131 - PS E</option>
                                        <option>COMP 131 - PS F</option>
                                        <option>COMP 131 - PS G</option>
                                        <option>COMP 131 - PS H</option>
                                    </select>

                                    @error('desiredPS')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-4">
                                    <button class="btn btn-primary" style="margin-bottom: 25px">Request PS Change</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>



    </div>
@endsection
