@extends('guest.master')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="wrapper-page">

            <div class="m-t-40 account-pages">
                <div class="text-center account-logo-box">
                    <h2 class="text-uppercase">
                        <a href="{{ url('/') }}" class="text-success">
                            <span>PEMERINTAH KOTA SALATIGA</span>
                        </a>
                        <a href="{{ url('/') }}" class="text-success">
                            <span>SISTEM INFORMASI PENGAWASAN DAERAH</span>
                        </a>
                    </h2>
                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                </div>
                <div class="account-content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group m-b-25">
                            <div class="col-12">
                                <label for="emailaddress">Email address</label>
                                <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" placeholder="john@deo.com">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group m-b-25">
                            <div class="col-12">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-muted float-right">Forgot your password?</a>
                                @endif
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group m-b-20">
                            <div class="col-12">

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remembercheck" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remembercheck">Remember me</label>
                                </div>

                            </div>
                        </div>

                        

                        <div class="form-group account-btn text-center m-t-10">
                            <div class="col-12">
                                <button class="btn w-lg btn-rounded btn-lg btn-primary waves-effect waves-light" type="submit">Sign In</button>
                            </div>
                        </div>

                    </form>

                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- end card-box-->


            <div class="row m-t-50">
                <div class="col-sm-12 text-center">
                    {{-- <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-dark m-l-5">Sign Up</a></p> --}}
                </div>
            </div>

        </div>
        <!-- end wrapper -->

    </div>
</div>
@endsection