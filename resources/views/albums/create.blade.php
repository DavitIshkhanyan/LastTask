@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Create Album</h3>
        <form action="/albums/store" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="title" class="form-control" placeholder="Album Title">
            </div>

            <div class="form-group">
                <label>Album Cover</label>
                <input type="file" name="cover_image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
