
@extends('layouts.app')
@section('content')
@section('pageTitle')
    <title>{{ trans('global.login') }} </title>
@endsection

    <body class="">
        <!--wrapper-->
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="mb-4 text-center">
                                <img src="assets/images/favicon.png" width="50" alt="Imenso" />
                            </div>
                          
                            <div class="card">
                                <div class="card-body">
                                    @if (\Session::has('message'))
                                        <p class="alert alert-info">
                                            {{ \Session::get('message') }}
                                        </p>
                                    @endif
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign in</h3>
                                            <p>Don't have an account yet? <a href="{{ route('register') }}">Sign
                                                    up here</a>
                                            </p>
                                        </div>


                                        <div class="form-body">
                                            <form action="{{ route('login') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="col-12 form-group">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input type="email"
                                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                        id="email" placeholder="{{ trans('global.login_email') }}"
                                                        name="email" value="{{ old('email', null) }}">
                                                    @if ($errors->has('email'))
                                                        <div class="help-block text-danger">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="col-12 form-group">
                                                    <label for="password" class="form-label">Enter Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password"
                                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            required placeholder="{{ trans('global.login_password') }}"
                                                            name="password" id="password">
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                                class='bx bx-hide'></i></a>
                                                        @if ($errors->has('password'))
                                                            <div class="help-block text-danger">
                                                                {{ $errors->first('password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" name="remember" id="remember">
                                                            <label for="remember">{{ trans('global.remember_me') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> <a href="{{ route('password.request') }}">Forgot Password?</a>
                                                </div>
                                                <br>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="bx bxs-lock-open"></i>{{ trans('global.login') }}</button>
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
        <!--end wrapper-->
    @endsection
    <!--plugins-->
    @section('scripts')
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
