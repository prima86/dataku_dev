@extends('auth.main_auth')
@section('content')
              <form method="POST" action="{{ route('login') }}">
                @csrf
                {{-- {{print_array($user)}} --}}
                {{-- <p class="text-muted" style="color:#007BFF;text-shadow: 2px 2px 0 rgba(255, 255, 255, 0.3);">Sign In to your account</p> --}}
                {{-- <div class="text-white my-1" style="">
                  <h6 style="font-family: me123;" class="text-center">
                    welcome back commander!
                  </h6>
                </div> --}}
                <div id="input-username" class="input-group mb-3">
                  @if (!empty($user->username))
                    {{-- <div id="saved-account" class="ml-auto mr-auto">
                      <div class="img-responsive img-thumbnail ratio-4-3" style="background-image:url('{{get_avatar($user->avatar)}}') !important;"></div>
      								<div class="text-center">
      									<img id="account-avatar" src="{{ show_avatar(Config::get('dataku.avatar_path'). $user->avatar) }}"
      										class="img-rounded img-thumbnail"
                          style="max-height:400px;min-height:200px;width:300px;object-fit: cover;"
      										data-toggle="tooltip" title="click to switch account" data-placement="bottom"
      									/>

                      </div>
      								<input type="hidden" placeholder="username" id="username" class="form-control" name="username" value="{{$user->username}}" autofocus>
      							</div> --}}

                    <div id="saved-account" class="ml-auto mr-auto rounded img-responsive ratio-3-4" title="click to switch account"
                          style="background-image:url('{{get_avatar($user->avatar)}}') !important;
                          max-width:250px;border:5px solid #fff;cursor: pointer;">
                          <div style="margin-top:-33px;height:33px; background: linear-gradient(to right, rgba(0,0,0,1), rgba(0,0,0,0));" class="text-white p-1">
                            {{$user->username}}
                          </div>
                      <input type="hidden" placeholder="username" id="username" class="form-control" name="username" value="{{$user->username}}" autofocus>
                    </div>
                  @else
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="username or email" required autofocus>
                    {{-- {{print_r($errors)}} --}}
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                  @endif
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <!-- <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="input-group mb-4">
                  <div class="mx-auto">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}

                    @if ($errors->has('g-recaptcha-response'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="ml-auto mr-2">
                    <button type="submit" class="btn btn-transparent px-4">Login</button>
                  </div>
                  <div class="mr-auto p-0">
                    <a class="btn btn-transparent mr-3" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                  </div>
                </div>
              </form>
@endsection
