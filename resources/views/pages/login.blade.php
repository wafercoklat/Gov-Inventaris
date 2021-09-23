<!DOCTYPE html>
<html lang="en">

{{-- HEAD --}} 
@include('components.head-meta')

<body>
{{-- CONTENTS --}}
    <div class="wrapper">
        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>

        <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url(images/login-bg.jpg);">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(images/login-inner-bg.jpg);">
                        <div class="login-fancy">
                            <h2 class="text-white mb-20">Siperiang App</h2>
                            <p class="mb-20 text-white">Sistem Informasi Perpindahan dan Inventarisir Barang</p>
                            <ul class="list-unstyled  pos-bot pb-30">
                                <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                                <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-lg-4 col-md-6 bg-white">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">Sign In</h3>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="name">Username* </label>
                                <input id="username" class="web form-control" type="text" placeholder="Username" name="username">
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">Password* </label>
                                <input id="password" class="Password form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <input type="checkbox" class="form-control" name="two" id="two" />
                                    <label for="two"> Remember me</label>
                                    <a href="password-recovery.html" class="float-right">Forgot Password?</a>
                                </div>
                            </div>
                            <button type="submit" class="button">
                                <span>Log in</span>
                                <i class="fa fa-check"></i>
                            </button>
                            <p class="mt-20 mb-0">Don't have an account? <a href="{{ route('register') }}"> Create one here</a></p>
                        </div>
                    </form>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>

{{-- FOOTER --}}
@include('components.foot-script')
</body>
</html>