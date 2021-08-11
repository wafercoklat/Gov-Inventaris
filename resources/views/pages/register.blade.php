<!DOCTYPE html>
<html lang="en">

{{-- HEAD --}} @include('components.head-meta')

<body>
    {{-- CONTENTS --}}
    <div class="wrapper">
        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>

        <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url(images/register-bg.jpg);">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-4 offset-lg-1 col-md-6 login-fancy-bg bg parallax" style="background-image: url(images/register-inner-bg.jpg);">
                        <div class="login-fancy">
                            <h2 class="text-white mb-20">Hello world!</h2>
                            <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose responsive template along with powerful features.</p>
                            <ul class="list-unstyled pos-bot pb-30">
                                <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                                <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 bg-white">
                        <form action="{{ route('register') }}" method="post">
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

                            <div class="login-fancy pb-40 clearfix">
                                <h3 class="mb-30">Signup</h3>
                                <div class="row">
                                    <div class="section-field mb-20">
                                        <label class="mb-10" for="">Name* </label>
                                        <input type="text" placeholder="Name*" id="email" class="form-control" name="name">
                                    </div>
                                    <div class="section-field mb-20">
                                        <label class="mb-10" for="">Email* </label>
                                        <input type="email" placeholder="Email*" id="email" class="form-control" name="email">
                                    </div>
                                    <div class="section-field mb-20">
                                        <label class="mb-10" for="">Password* </label>
                                        <input class="Password form-control" id="password" type="password" placeholder="Password" name="password">
                                    </div>
                                    <button type="submit" class="button">
                                        <span>Signup</span>
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <p class="mt-20 mb-0">Don't have an account? <a href="{{ route('login') }}"> Create one here</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
        </div>

        {{-- FOOTER --}} @include('components.foot-script')
</body>

</html>