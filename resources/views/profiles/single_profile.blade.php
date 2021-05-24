@extends('layouts.app')
@section('content')
        @if (session('info'))
            <div class="alert alert-success mx-5" role="alert">
                {{ session('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="container card">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class=" d-flex justify-content-around flex-row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $profile -> avatar) }}" width="200px" height="200px">
                            <h2>{{ $profile->username }}</h2>

                            @if ( Auth::user()->hasFriendRequestPending($profile) )
                                <p>Waiting friend confirmation from {{ $profile->username }}</p>
                            @elseif ( Auth::user()->hasFriendRequestReceived($profile) )
                                <a href="{{ route('friend.accept', ['username' => $profile->username]) }}"
                                   class="btn btn-primary mb-2">Confirm</a>
                            @elseif ( Auth::user()->isFriendWith($profile) )
                                <p>{{ $profile->username }} is in friends</p>

                                <form action="{{ route('friend.delete', ['username' => $profile->username]) }}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-primary my-2" value="Unfriend">
                                </form>
                            @elseif( Auth::user()->id !== $profile->id )
                                <a href="{{ route('friend.add', ['username' => $profile->username]) }}"
                                   class="btn btn-primary mb-2">Add Friend</a>
                            @endif
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
{{--                                            <img src="storage/posts/{{$user -> avatar}}" width="40px" height="40px">--}}
                                        <img src="{{ asset('storage/' . $profile -> avatar) }}" width="40px" height="40px">
                                    </a>
                                        <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="nav-link">
                                            <h2>{{ $user->username }}</h2>
                                        </a>
                                    </div>

                                @endforeach
                                @endif

{{--                                <h1>{{ $profile->username }} Albums.</h1>--}}
{{--                                @if(count($profile->albums()) > 0)--}}
{{--                                    <div id="albums" class="container">--}}
{{--                                        <div class="row text-center">--}}
{{--                                            @foreach($profile->albums() as $album)--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <a href="/albums/{{ $album->id }}">--}}
{{--                                                        <img class="img-thumbnail" src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->title }}" width="200px" height="200px">--}}
{{--                                                    </a>--}}
{{--                                                    <br>--}}
{{--                                                    <h4>{{ $album->title }}</h4>--}}
{{--                                                </div>--}}
{{--                                                @if($loop->iteration % 3 == 0)--}}
{{--                                                    </div><div class="row text-center">--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <p>No Albums To Display</p>--}}
{{--                                @endif--}}
                        </div>
                    </div>
                    <hr>
                    <h1> Albums</h1>
                    @if(count($profile->albums()) > 0)
                        <div id="albums" class="container">
                            <div class="row text-center">
                                @foreach($profile->albums() as $album)
                                    <div class="col-md-4">
                                        <a href="/albums/{{ $album->id }}">
                                            <img class="img-thumbnail" src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->title }}" width="200px" height="200px">
                                        </a>
                                        <br>
                                        <h4>{{ $album->title }}</h4>
                                    </div>
                                    @if($loop->iteration % 3 == 0)
                            </div><div class="row text-center">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p>No Albums To Display</p>
                    @endif
                </div>
            </div>
        </div>
@endsection
