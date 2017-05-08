<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
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

                <h1 class="m-b-md">
                    OSCON Tshirt tracker
                </h1>

                <h2>Leaderboard</h2>

                <div class="leaderboard">
                    @php
                        $lastShirts = 0;
                        $place = 1;
                    @endphp
                    @foreach ($leaderboard as $user)
                        @php
                            $place = $user->tshirt_count === $lastShirts ? $place : $loop->index + 1;
                        @endphp
                        <div class="col-xs-12 col-md-8 col-md-offset-2 leaderboard-item-container">
                            <div class="leaderboard-item">
                                <div class="lb-placement">
                                    {{ $place }}
                                </div>
                                <div class="lb-avatar">
                                    <img src="{{$user->avatar_url ?: 'img/default.svg'}}">
                                </div>
                                <div class="lb-details">
                                    <strong>{{$user->name}}</strong><br/>
                                     {{$user->tshirt_count}} shirts
                                </div>
                                <div class="lb-count">
                                    {{$user->tshirt_emoji}}
                                </div>
                            </div>
                        </div>
                        @php
                            $lastShirts = $user->tshirt_count;
                        @endphp
                    @endforeach
                </div>

            </div>
        </div>
    </body>
</html>
