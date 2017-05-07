@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">{{ $user->name }} Dashboard</div>

                <div class="panel-body">
                    <div class="panel panel-item">Shirt Admin</div>
                    <div class="text-info">You currently have {{ $user->tshirt_count > 0 ? $user->tshirt_count : 'no' }} shirts</div>
                    <div>
                        <a class="btn btn-primary" href="/tshirt/{{ $user->user_code }}/add">Add Shirt</a>
                    </div>

                    @if($user->status =='moderator')
                        <div class="panel panel-item">Pending Users</div>

                        @foreach ($pendingUsers as $pendingUser)
                        <div>
                            <a class="btn btn-primary" href="/tshirt/{{ $user->user_code }}/approve/{{$pendingUser->user_code}}">Approve {{ $pendingUser->name }} ({{$pendingUser->user_code}}) - {{$pendingUser->tshirt_count}} shirts</a>
                        </div>
                        @endforeach

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
