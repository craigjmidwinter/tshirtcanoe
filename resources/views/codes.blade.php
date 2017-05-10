@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Admin Links</div>

                    <div class="panel-body">
                        @foreach ($users as $user)
                            <a class="btn btn-primary btn-md btn-block" href="/tshirt/{{ $user->user_code }}">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection