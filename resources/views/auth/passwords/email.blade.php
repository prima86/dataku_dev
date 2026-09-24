@extends('auth.main_auth')

@section('content')

                {{-- <div class="card-body"> --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        {{-- <div class="form-group row"> --}}
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mt-2">
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display() !!}

                              @if ($errors->has('g-recaptcha-response'))
                                  <span class="text-danger">
                                      <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                  </span>
                              @endif
                            </div>

                        {{-- </div> --}}

                        <div class="mt-3">
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="btn btn-transparent">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            {{-- </div> --}}
                        </div>
                    </form>
                {{-- </div> --}}
@endsection
