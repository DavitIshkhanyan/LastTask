@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Upload Photo</h3>
        <form action="/photos/store" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" placeholder="Photo Title">
            </div>

            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
            <input type="hidden" name="album_id" value="{{ $album_id }}">
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
