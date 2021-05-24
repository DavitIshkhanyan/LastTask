@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-6">
                <h3>My Friends</h3>

                @if(!$friends->count())
                    <p>You have not friends.</p>
                @else
                    @foreach($friends as $user)
                        <div class="d-flex">
                            <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
{{--                                <img src="storage/posts/{{$user -> avatar}}" width="40px" height="40px">--}}
                                <img src="{{ asset('storage/' . $user -> avatar) }}" width="60px" height="60px">
                            </a>
                            <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
                                <h2>{{ $user->username }}</h2>
                            </a>
                        </div>

                    @endforeach
                @endif
            </div>
            <div class="col-lg-6">
                <h3>Friend Requests</h3>

                @if(!$requests->count())
                    <p>You have not friend requests.</p>
                @else
                    @foreach($requests as $user)
                        <div class="d-flex">
                            <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
                                <img src="{{ asset('storage/' . $user -> avatar) }}" width="60px" height="60px">
                            </a>
                            <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
                                <h2>{{ $user->username }}</h2>
                            </a>
                        </div>

                    @endforeach
                @endif
            </div>

        </div>
    </div>
@endsection
