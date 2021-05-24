@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @guest
                    <h1>Welcome!</h1>
                    <p>Please Login</p>
                    @else
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="d-flex">
{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if (session('info'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('info') }}--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                    {{ __('You are logged in!') }}--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
                        <div>
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" width="200px" height="auto">
                        </div>
{{--                        <div>--}}

                            <div class="col-md-12">
                                <h1>{{ Auth::user()->username }}</h1>
                                <p>{{ Auth::user()->email }}</p>
                                @if( Auth::user()->full_name)
                                    <p>{{ Auth::user()->full_name }}</p>
                                @endif
                                @if(Auth::user()->gender)
                                    <p>{{ Auth::user()->gender->title }}</p>
                                @endif
    {{--                                                    <p>{{ $profile->avatar }}</p>--}}
                                @if(Auth::user()->DOB)
                                    <p>{{ Auth::user()->DOB }}</p>
                                @endif
                            </div>
{{--                        </div>--}}
{{--                        <a href=""></a>--}}
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>

@endsection
