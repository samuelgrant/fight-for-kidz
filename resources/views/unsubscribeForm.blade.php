@extends('layouts.app')

 @section('content')
<div class="container auth">    

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-body auth-body">
                    @include('layouts.messages')
                    <h2 class="text-center mb-3">Unsubscribe</h2>
                    <form method="POST" action="{{ route('mail.unsubscribe') }}" >
                        @csrf
                        <div class="form-group row mb-0">
                            <label for="email" class="col-md-12 col-form-label mb-3 text-center">Please enter your email address</label>
                             <div class="col-md-12">
                                <input class="form-control mb-4" type="email" name="email" id="email" required>
                                <input type="hidden" name="token" value="{{$token}}">
                            </div>                            
                        </div>

                         <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-danger" style="width: 100%">Unsubscribe</button>
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
