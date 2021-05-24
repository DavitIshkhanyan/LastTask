@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('info'))
                    <div class="alert alert-success" role="alert">
                        {{ session('info') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h1>Albums</h1>
                @if(count($albums) > 0)
                    <div id="albums">
                        <div class="row text-center">
                            @foreach($albums as $album)
                                <div class="col-md-4">
                                    <a href="/albums/{{ $album->id }}">
{{--                                        <img class="img-thumbnail" src="storage/{{ $album->cover_image }}" alt="{{ $album->title }}" width="200px" height="200px">--}}
                                        <img class="img-thumbnail" src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->title }}" width="200px" height="200px">
                                    </a>
                                    <br>
                                    <h4>{{ $album->title }}</h4>
{{--                                    <form action="/albums/{{$album->id}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method("DELETE")--}}
{{--                                        <input class="btn btn-primary" type="submit" value="Delete album">--}}
{{--                                    </form>--}}
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
                <a class="btn btn-primary mt-4" href="{{ route('albums.create') }}">Create New Album</a>
            </div>
        </div>
    </div>
@endsection
