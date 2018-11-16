@extends('admin.layouts.app')

 @section('page')
<div class="container auth">

    <h2 class="text-center my-5">Create New User</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-card">
                 <div class="card-body auth-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                         <div class="form-group row mb-0">
                            <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>
                             <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                 @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row mb-0">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                             <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                 @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <?php
                            global $password;
                            $password = str_random(8)
                        ?>

                         <div class="form-group row mb-0">
                            {{-- <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label> --}}
                             <div class="col-md-12">
                             <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{$password}}" required hidden>
                                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            {{-- <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label> --}}
                             <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{$password}}" required hidden>
                            </div>
                        </div>
                         <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-danger" style="width: 100%">{{ __('Register') }}</button>
                                {!! app('captcha')->render(); !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
