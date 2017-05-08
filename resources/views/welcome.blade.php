<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Laravel</title>

        <!-- Fonts -->


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
            .leaderboard-item-container{
                padding: 1em;
            }
            .leaderboard-item{
                height: 70px;
                position:relative;
                border: solid #636b6f;
                border-radius: 14px;
            }
            .total {
                vertical-align: bottom;
                height: 100%;
                display: inline;
                font-size: 2em;
            }
            .avatar-container{
                text-align: center;
                width:100%;
                padding-left: 10px;
                margin-left: .25em;
                margin-right: .25em;
            }
            .avatar {
                display: inline-block;
                width: 60px;
                overflow: hidden;
                height: 60px;
                border-radius: 30px;
                text-align: center;
            }
            .avatar img {
                width:100%
            }
            .placement {
                font-size: large;
                position:absolute;
            }
        </style>
    </head>
    <body>

                <div class="title m-b-md">
                    OSCON Tshirt tracker
                </div>

                <div>Leaderboard</div>
                <div class="leaderboard">
                    @php
                        $lastShirts = 0;
                    @endphp
                    @foreach ($leaderboard as $user)
                        @php
                            $place = $user->tshirt_count === $lastShirts ? $place : $loop->index + 1;
                        @endphp
                        <div class="col-xs-8 leaderboard-item-container">
                            <div class="row leaderboard-item">
                                <div class="col-xs-3">
                                    <div class="placement">
                                        {{  $place }}
                                    </div>
                                    <div class="avatar-container">
                                        <div class="avatar">
                                            <img src="{{$user->avatar_url ?: 'img/default.svg'}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-9 total">
                                    {{$user->name}} - {{$user->tshirt_count}} shirts
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
