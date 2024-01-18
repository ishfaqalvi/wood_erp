@extends('auth.layout.app')

@section('page_title', 'Reset Password')

@section('page_content')
<form class="login-form needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>
    @csrf
    <div class="card mb-0">
        <div class="card-body">
            <div class="text-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                    <img src="https://demo.interface.club/limitless/demo/template/assets/images/logo_icon.svg" class="h-48px" alt="">
                </div>
                <h5 class="mb-0">{{ __('Reset Password') }}</h5>
                <span class="d-block text-muted">Enter your email below</span>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger border-0 alert-dismissible fade show">
                    @foreach ($errors->all() as $error)
                    <span class="fw-semibold">Oh snap!</span> {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success border-0 alert-dismissible fade show">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">{{ __('Email Address') }}</label>
                <div class="form-control-feedback form-control-feedback-start">
                    <input type="email" name="email" class="form-control" placeholder="john@doe.com" required>
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-circle text-muted"></i>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
