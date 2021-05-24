@extends('layouts.app')
@section('content')
    <h1>{{ $album->title }}</h1>
    <a class="btn btn-primary" href="/albums">Go Back</a>
    @if(Auth::user()->id === $user_id)
    <a class="btn btn-success" href="/photos/create/{{ $album->id }}">Upload Photo To Albom</a>
    <form action="/albums/{{$album->id}}" method="post" class="mt-4">
        @csrf
        @method("DELETE")
        <input class="btn btn-primary" type="submit" value="Delete album">
    </form>
    @endif
    <hr>
{{--    {{ print_r($album->photos()) }}--}}
    @if(count($album->photos) > 0)
        <div id="albums row">
            <div class="text-center col-lg-10" style="margin: auto">
                @foreach($photos as $photo)
{{--                    <img class="img-thumbnail" src="/storage/{{ $photo->photo }}" alt="{{ $photo->title }}" width="200px" height="200px">--}}
{{--                    <img class="img-thumbnail" src={{ asset('storage/'.$photo->photo) }} alt="{{ $photo->title }}" width="200px" height="200px">--}}
                    <div class="mb-5">
                    <img class="img-thumbnail" src="/storage/album_photos/{{ $photo->photo }}" alt="{{ $photo->title }}" width="400px" height="200px">
{{--                    @if(Auth::user()->id === $user_id)--}}
{{--                        <form action="/photos/{{$photo->id}}" method="post">--}}
{{--                            @csrf--}}
{{--                            @method("DELETE")--}}
{{--                            <input class="btn btn-primary" type="submit" value="Delete photo">--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                        <div class="media-body"></div>--}}
                    <ul class="list-inline">
                        <li class="list-inline-item">{{ $photo->created_at->diffForHumans() }}</li>
                        @if( Auth::user()->isFriendWith($photo->album->user) ||  Auth::user()->id === $photo->album->user->id )
                            <li class="list-inline-item">
{{--                                <a href="{{ route('photo.like', ['id' => $photo->id]) }}">Like</a>--}}
                                @if( ! Auth::user()->hasLikedPhoto($photo) )
                                    <a href="{{ route('photo.like', ['id' => $photo->id]) }}">Like</a>
                                @else
                                    <a href="{{ route('photo.like.destroy', ['id' => $photo->id]) }}">Like</a>
                                @endif
                            </li>
                        @endif
                            <li class="list-inline-item">
                                {{ $photo->likes->count() }} {{ Str::plural('Like', $photo->likes->count()) }}
                            </li>
{{--                        @endif--}}
                    </ul>

                    @if( ! Auth::user()->isFriendWith($photo->album->user) &&  Auth::user()->id !== $photo->album->user->id )
                        <p>You can comment and like only your and friend's photos</p>
                    @else
                        @foreach($photo->comments as $comment)
                            <div class="mb-5">
                                <div class="d-flex justify-content-center">
                                    <img class="img-thumbnail" src="/storage/{{ App\User::find($comment->user_id)->avatar }}" alt="avatar" width="60px" height="60px">
                                    <p>{{ App\User::find($comment->user_id)->username }}</p>
                                </div>
                                <p>{{ $comment->body }}</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">{{ $comment->created_at->diffForHumans() }}</li>
                                    <li class="list-inline-item">
                                        @if( ! Auth::user()->hasLikedComm($comment) )
                                            <a href="{{ route('comment.like', ['id' => $comment->id]) }}">Like</a>
                                            @else
                                            <a href="{{ route('comment.like.destroy', ['id' => $comment->id]) }}">Like</a>
                                        @endif
                                    </li>
                                    <li class="list-inline-item">
                                        {{ $comment->likes->count() }} {{ Str::plural('Like', $comment->likes->count()) }}
                                    </li>
                                </ul>
                                @if(Auth::user()->id === App\User::find($comment->user_id)->id)
                                    <form action="{{ route('reply.destroy', ['id' => $comment->id]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-primary btn-sm">Delete My comment</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach

                    <form method="POST" action="{{ route('photo.reply', ['id' => $photo->id]) }}" class="mb-4">
                        @csrf
                        <div class="form-group">
                            <textarea name="reply-{{ $photo->id }}" class="form-control{{ $errors->has("reply-{$photo->id}") ? ' is-invalid' : '' }}"
                                      placeholder="Comment" rows="3"></textarea>
                            @if ($errors->has("reply-{$photo->id}"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("reply-{$photo->id}") }}
                                </div>
                            @endif
                        </div>
{{--                        <input type="submit" class="btn btn-primary btn-sm" value="Reply">--}}
                        <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                    </form>
                    @endif

                        @if(Auth::user()->id === $user_id)
                            <form action="/photos/{{$photo->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-primary btn-sm">Delete photo</button>
                            </form>
                        @endif
                    </div>
                @endforeach
                {{ $photos->links() }}
            </div>
        </div>
        @else
        <p>No Photos to Display</p>
    @endif
@endsection
