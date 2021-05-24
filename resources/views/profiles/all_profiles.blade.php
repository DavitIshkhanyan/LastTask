@extends('layouts.app')
@section('content')
    @foreach($profiles as $profile)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card d-flex justify-content-around flex-row">

                        <div class="col-md-4">
                            <a href="{{ route('profile.index', ['username' => $profile->username ]) }}" class="nav-link">
                                <img src="{{ asset('storage/' . $profile -> avatar) }}" width="200px" height="200px">
                            </a>
                            <a href="{{ route('profile.index', ['username' => $profile->username ]) }}" class="nav-link">
                                <h2>{{ $profile->username }}</h2>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <p>{{ $profile->email }}</p>

                            @if( $profile->full_name)
                                <p>{{ $profile->full_name }}</p>
                            @endif
                            @if($profile->gender)
                                <p>{{ $profile->gender->title }}</p>
                            @endif
                            @if($profile->DOB)
                                <p>{{ $profile->DOB }}</p>
                            @endif
                        </div>

{{--                        @if ( Auth::user()->hasFriendRequestPending($profile) )--}}
{{--                            <p>Waiting friend confirmation from {{ $profile->username }}</p>--}}
{{--                        @elseif ( Auth::user()->hasFriendRequestReceived($profile) )--}}
{{--                            <a href="{{ route('friend.accept', ['username' => $profile->username]) }}"--}}
{{--                               class="btn btn-primary mb-2">Confirm</a>--}}
{{--                        @elseif ( Auth::user()->isFriendWith($profile) )--}}
{{--                            <p>{{ $profile->username }} is in friends</p>--}}

{{--                            <form action="{{ route('friend.delete', ['username' => $profile->username]) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <input type="submit" class="btn btn-primary my-2" value="Unfriend">--}}
{{--                            </form>--}}
{{--                        @elseif( Auth::user()->id !== $profile->id )--}}
{{--                            <a href="{{ route('friend.add', ['username' => $profile->username]) }}"--}}
{{--                               class="btn btn-primary my-2 h-25">Add Friend</a>--}}
{{--                        @endif--}}

                        <div class="col-lg-0 col-lg-offset-3">
                            <div>
                            <h4>{{ $profile->username }} friends.</h4>
                            </div>

                            @if(!$profile->friends()->count())
                                <p>{{ $profile->username }} has no friends</p>
                            @else
                                @foreach($profile->friends() as $user)
                                    <div class="d-flex">
                                    <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
{{--                                        <img src="storage/posts/{{$user -> avatar}}" width="40px" height="40px">--}}
                                        <img src="{{ asset('storage/' . $user -> avatar) }}" width="40px" height="40px">
                                    </a>
                                    <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
                                        <h2>{{ $user->username }}</h2>
                                    </a>
                                    </div>
                                    @if($loop->iteration % 4 == 0)
                                        @break
                                    @endif

                                @endforeach
                            @endif
                        </div>
                        </div>
            {{-- <a href="/posts/{{$post->id}}/edit">Edit</a>
            <form action="/posts/{{$post->id}}" method="post">
                @csrf
                @method("DELETE")
                <input type="submit" value="delete">
            </form> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
