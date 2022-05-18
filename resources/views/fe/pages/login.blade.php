@extends('fe.master')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Login</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-bs-toggle="tab" href="#lg1">
                            <h4>Đăng Nhập</h4>
                        </a>
                        <a data-bs-toggle="tab" href="#lg2">
                            <h4>Đăng ký</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{session('error')}}</div>
                                    @endif
                                    <br>
                                    <form action="{{route('loginUser')}}" method="post">
                                        @csrf
                                        <input type="text" name="email" placeholder="Email" />
                                        <input type="password" name="password" placeholder="Mật khẩu" />
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" />
                                                <a class="flote-none" href="javascript:void(0)">Ghi nhớ</a>
                                                <a href="#">Quên mật khẩu?</a>
                                            </div>
                                            <button type="submit"><span>Đăng nhập</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="{{route('register')}}" method="post">
                                        @csrf
                                        <input type="text" name="name" placeholder="Tên" value="{{old('name')}}" />
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input name="email" placeholder="Email" type="email" value="{{old('email')}}" />
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="password" name="password" placeholder="Mật khẩu" value="{{old('Password')}}" />
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="button-box">
                                            <button type="submit"><span>Đăng ký</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->

<!-- Search Modal Start -->
<div class="modal popup-search-style" id="searchActive">
    <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <div class="modal-overlay">
        <div class="modal-dialog p-0" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Search Your Product</h2>
                    <form class="navbar-form position-relative" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search here...">
                        </div>
                        <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Modal End -->

<!-- Login Modal Start -->
<div class="modal popup-login-style" id="loginActive">
    <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <div class="modal-overlay">
        <div class="modal-dialog p-0" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="login-content">
                        <h2>Log in</h2>
                        <h3>Log in your account</h3>
                        <form action="#">
                            <input type="text" placeholder="Username">
                            <input type="password" placeholder="Password">
                            <div class="remember-forget-wrap">
                                <div class="remember-wrap">
                                    <input type="checkbox">
                                    <p>Remember</p>
                                    <span class="checkmark"></span>
                                </div>
                                <div class="forget-wrap">
                                    <a href="#">Forgot your password?</a>
                                </div>
                            </div>
                            <button type="button">Log in</button>
                            <div class="member-register">
                                <p> Not a member? <a href="login.html"> Register now</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop