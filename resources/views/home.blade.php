@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">{{ $user->name }} Dashboard</div>

                <div class="panel-body">
                    <div class="panel panel-item">Shirt Admin</div>
                    <div class="text-info">You currently have <strong>{{ $user->tshirt_count > 0 ? $user->tshirt_count : 'no' }}</strong> shirts</div>
                    <div>
                        <a class="btn btn-primary" href="/tshirt/{{ $user->user_code }}/add">Add Shirt</a>
                        <a class="btn btn-danger" href="/tshirt/{{ $user->user_code }}/remove">Remove Shirt</a>
                    </div>

                    <div>
                        <form role="form" method="POST" action="/tshirt/{{ $user->user_code }}/update_avatar">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$user->user_code}}" name="user_code">
                            <input type="text" name="avatar" placeholder="url for avatar photo" value="{{$user->avatar_url}}" /> <button type="submit" class="btn btn-primary">Update avatar url</button>
                        </form>

                        <div class="text-info"><strong>Enter your extra shit on separate lines:</strong><br/>(comma separated values: label, emoji, count (default: 1)</div>

                        <form role="form" method="POST" action="/tshirt/{{ $user->user_code }}/update_misc_shit">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$user->user_code}}" name="user_code">
                            <textarea type="text" name="misc_shit" >{{$user->misc_shit}}</textarea> <button type="submit" class="btn btn-primary">Update my shit</button>
                        </form>


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
