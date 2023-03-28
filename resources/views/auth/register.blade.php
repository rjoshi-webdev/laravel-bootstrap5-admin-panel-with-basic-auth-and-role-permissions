@extends('layouts.app')
@section('PageTitle')
    <title>{{ trans('global.register') }}</title>
@endsection
@section('content')

    <body class="">
        <!--wrapper-->
        <div class="wrapper">
            <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="my-4 text-center">
                                <img src="assets/images/favicon.png" width="50" alt="" />
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign Up</h3>
                                            <p>Already have an account? <a href="{{ route('login') }}">Sign in
                                                    here</a>
                                            </p>
                                        </div>
                                        <br>
                                        <div class="form-body">
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" placeholder="Name"
                                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            name="name" value="{{ old('name') }}" required autofocus>

                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br>
                                                
                                                <div class="form-group row">
                                                    <label for="email"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" placeholder="E-mail"
                                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            name="email" value="{{ old('email') }}" required>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br>
                                              
                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" placeholder="Password"
                                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            name="password" required>

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br> 
                                                <div class="form-group row">
                                                    <label for="password-confirm"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password"
                                                            name="password_confirmation" required>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="col-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">I read
                                                            and agree to Terms & Conditions</label>
                                                    </div>
                                                </div> <br> 
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class='bx bx-user'></i> {{ __('Register') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>


    @endsection
