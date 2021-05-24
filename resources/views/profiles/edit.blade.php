@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile Update</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
                            @csrf
                            @method("PUT")

                            @if (session('info'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('info') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full name') }}</label>

                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control" name="full_name" value="{{  Auth::user()->full_name }}" autocomplete="first_name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Request::old('email') ?: Auth::user()->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Request::old('username') ?: Auth::user()->username }}" required autocomplete="username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="DOB" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>

                                <div class="col-md-6">
                                    <input type="date" id="DOB" class="form-control" name="DOB" value="{{ Auth::user()->DOB }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <select id="gender" class="form-select form-control" aria-label="Default select example" name="gender">
                                        @if( Auth::user()->gender_id )
                                        <option value="{{ Auth::user()->gender_id }}" selected>{{ Auth::user()->gender->title }}</option>
                                        <option value="{{(Auth::user()->gender_id==1)?2:1}}">{{ (Auth::user()->gender->title=='Male')?'Female':'Male' }}</option>
                                            @else
                                        <option selected></option>
                                        <option value=1>Male</option>
                                        <option value=2>Female</option>
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Upload Avatar') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="avatar" id="avatar" class="@error('avatar') is-invalid @enderror">

                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-9">
                                    <a class="nav-link" href="{{ route('edit_pass') }}">Change Password</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
