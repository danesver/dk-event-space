@extends('layouts.app')

@section('content')

<main>

<!-- breadcrumb area start -->
<!--<div class="breadcrumb__area breadcrumb__height fix p-relative" data-bg-color="#F6F8FF">
    <div class="breadcrumb__shap">
        <div class="shap">
            <img src="assets/img/error/shap.png" alt="">
        </div>
        <div class="shap-2">
            <img src="assets/img/error/shape-2.png" alt="">
        </div>
        <div class="shap-3">
            <img src="assets/img/error/shape-3.png" alt="">
        </div>
        <div class="shap-4">
            <img src="assets/img/error/shape-4.png" alt="">
        </div>
    </div>
    <div class="container">
        <div class="row gx-30">
            <div class="col-xl-12 col-md-12 text-center">
                <div class="breadcrumb__content z-index">
                    <div class="breadcrumb__section-title-box">
                        <h3 class="breadcrumb__title">Sign Up</h3>
                    </div>
                    <div class="breadcrumb__list">
                        <span><a href="">Home</a></span>
                        <span class="dvdr"><i class="fa-regular fa-chevron-right"></i></span>
                        <span>Sign Up</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- breadcrumb area end -->
<!-- rr-register area start  -->
<div class="rr-register-area pt-120 pb-120">
    <div class="container container-small">
        <div class="row">
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                <div class="rr-register-all-content">
                    <div class="rr-register-title-wrapper text-center mb-40">
                        <h3 class="rr-register-title">Welcome to Qaca House Booking Page!</h3>
                        <p>Enter your Credentials to access your account</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="rr-register-signup-form-wrapper">
                            <div class="rr-register-item-thumb">
                                <div class="rr-register-signup-item">
                                    <h6 class="rr-register-input-title">First Name</h6>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter First Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="rr-register-signup-item">
                                    <h6 class="rr-register-input-title">Email Address</h6>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="rr-register-signup-item">
                                    <div class="rr-register-wrap d-flex justify-content-between">
                                        <h6 class="rr-register-input-title">Password</h6>
                                        <a href="{{ route('password.request') }}">forgot password</a>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="rr-register-signup-item">
                                    <div class="rr-register-wrap d-flex justify-content-between">
                                        <h6 class="rr-register-input-title">{{ __('Confirm Password') }}</h6>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="rr-register-button">
                                <div class="rr-register-sing-buttom mb-25">
                                    <button type="submit" name="submit" class="rr-btn-2 wow rrfadeUp" style="width:100%;" data-wow-duration=".9s" data-wow-delay=".7s" style="visibility: visible; animation-duration: 0.9s; animation-delay: 0.7s; animation-name: rrfadeUp;">
                                       <span>Sign Up <i class="fa-solid fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="rr-register-sign-social text-center ">
                        <h5>Do you have an account? <a href="{{ route('login') }}"> Sign In</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- rr-register area end  -->
</main>

@endsection
