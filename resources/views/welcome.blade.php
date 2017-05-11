<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 1rem;
            }
        </style>
    </head>
    <body>

                <h1>
                    OSCON Tshirt Tracker
                </h1>
                <h3>Tipping Canoe has collected a combined total of {{$total}} shirts</h3>

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
                                    @if($user->other_shit)
                                        @foreach($user->other_shit as $othershit)
                                            <br/>{{$othershit['count']}} {{$othershit['label']}}
                                        @endforeach
                                    @endif
                                </div>
                                <div class="lb-count">
                                    <div>{{$user->tshirt_emoji}}</div>
                                    @if($user->other_shit)
                                        @foreach($user->other_shit as $othershit)
                                            <div>{{$othershit['emoji']}}</div>
                                        @endforeach
                                    @endif
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
