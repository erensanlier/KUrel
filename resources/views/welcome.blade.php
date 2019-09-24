<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KUrel Office</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                 align-items: center;
                 display: flex;
                 justify-content: center;
             }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/appointments') }}">My Appointments</a>
                        <a href="{{ url('/pending') }}">Pending Requests</a>
                        @can('SLC', \App\Request::class)
                        <a href="{{ url('/all') }}">All Requests</a>
                        @endcan
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    @else
                        <a href="{{ route('login') }}" style="color: #495057">SL Login</a>

                        {{--@if (Route::has('register'))
                            <a href="{{ route('register') }}" style="color: #495057">SL Register</a>
                        @endif--}}
                    @endauth
                </div>
            @endif

            <div class="content" style="margin-top: -120px">

                <div class="title m-b-md" style="color: #495057; margin-top: 400px">
                    <div><img src="img/karel.png" width="100"></div>
                    KUrel Office
                </div>

                <div class="links">
                    <a href="/request/create">New Appointment</a>
                    <a href="/request/create">Events</a>
                    <a href="/play">Karel IDE</a>
                    <a href="https://sl.ku.edu.tr">Our Website</a>
                    <a href="mailto:comp130-slcs-group@ku.edu.tr?Subject=About%20KUrel%20Office">Contact us</a>
                </div>

                <div class="content" style="margin-top: 100px">
                    <div class="row flex-center align-items-baseline">
                        <h2>Walk In Status: </h2>

                        <?php
                            $walkin = 'walk-in.txt';
                            $status = file_get_contents($walkin);
                            ?>

                        @auth
                            @if($status)
                            <a href="/status">
                                <div style="color: #5cd08d; margin-left: 10px"><h2>AVAILABLE</h2></div></a>
                            @else
                            <a href="/status">
                                <div style="color: #ae1c17; margin-left: 10px"><h2>BUSY</h2></div></a>
                            @endif
                        @else
                            @if($status)
                                <div style="color: #5cd08d; margin-left: 10px"><h2>AVAILABLE</h2></div>
                            @else
                                <div style="color: #ae1c17; margin-left: 10px"><h2>BUSY</h2></div>
                            @endif
                        @endauth


                    </div>

                    @auth
                    <div class="row flex-center">
                        <h2>Logged In As: </h2>
                        <h2 style="margin-left: 10px"> {{strtoupper(auth()->user()->role)}} -</h2>
                        <h2 style="margin-left: 6px">{{auth()->user()->name}}</h2>

                    </div>
                    @endauth

                </div>
            </div>
        </div>
    </body>
</html>
