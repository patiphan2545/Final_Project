<!doctype html>
<html lang="en">
<head>
   @include('layouts.partials.header')
</head>
<body class="hold-transition login-page">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        @if(isset($settings->logo))            
                        <a href="{{url('/')}}" class="h1">
                            <img src="{{asset('storage/'.$settings->logo)}}" class="img-fluid" style="max-width:180px">
                        </a>
                        @else                 
                        <a href="{{url('/')}}" class="h1"><b>{{env('APP_NAME')}}</b></a>
                        @endif
                        <p>{{ __('Reset Password') }}</p>
                    </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
