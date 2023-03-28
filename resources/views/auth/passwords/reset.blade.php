@extends('layouts.app')
@section('PageTitle')
    <title>Reset</title>
@endsection
@section('content')
<div class="wrapper">
    <div class="authentication-reset-password d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="card">
                    <div class="row g-0">
                        {{-- <div class="col-lg-5 border-end"> --}}
                            <div class="card-body">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/favicon.png') }}" width="50" alt="Imenso">
                                    </div>
                                    <h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
                                    <p class="text-muted">We received your reset password request. Please enter your new password!</p>
                                    <form method="POST" action="{{ route('password.request') }}">
                                        {{ csrf_field() }}
                                        <div>
                                            <input name="token" value="{{ $token }}" type="hidden">
                                            <div class="form-group has-feedback row">
                                                <div class="mb-3 mt-5">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" required placeholder="{{ trans('global.login_email') }}">
                                                </div>
                                               
                                                @if($errors->has('email'))
                                                    <p class="help-block text-danger">
                                                        {{ $errors->first('email') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="form-group has-feedback row">
                                                <div class="mb-3 ">
                                                    <label class="form-label">New Password</label>
                                                    <input type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">
                                                </div>
                                               
                                                @if($errors->has('password'))
                                                    <p class="help-block text-danger">
                                                        {{ $errors->first('password') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="form-group has-feedback row" >
                                                <div class="mb-3">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                                                </div>
                                              
                                                @if($errors->has('password_confirmation'))
                                                    <p class="help-block">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">{{ trans('global.reset_password') }}</button> <a href="{{route('login')}}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                            </div>
                                            
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="col-lg-7">
                            <img src="{{ asset('assets/images/login-images/forgot-password-frent-img.jpg') }}" class="card-img login-img h-100" alt="...">
                            </div>
                        </div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
