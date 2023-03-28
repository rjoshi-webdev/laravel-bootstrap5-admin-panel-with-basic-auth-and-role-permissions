@extends('layouts.app')
@section('PageTitle')
    <title>Forgot Password?</title>
@endsection
@section('content')
<body class="">
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box">
                <div class="card-body">
                    <div class="p-4 rounded  border">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/favicon.png') }}" width="50" alt="" />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                        <p class="text-muted">Enter your registered email ID to reset the password</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div>
                                <div class="form-group my-4">
                                    <label class="form-label">Email id</label>
                                    <input type="email" name="email" class="form-control" required="autofocus" placeholder="{{ trans('global.login_email') }}">
                                    @if($errors->has('email'))
                                        <p class="help-block">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('global.reset_password') }}
                                </button>
                                <a href="{{ route('login')}}" class="btn btn-light "><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
    </body>
  
@endsection


