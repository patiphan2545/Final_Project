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
                        <p>One Time Password (OTP) Verification</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('otp.post') }}">
                            @csrf

                            <p class="text-center">We sent a code to your phone : <strong>{{ substr(auth()->user()->phone, 0, 5) . '******' . substr(auth()->user()->phone,  -2) }}</strong></p>

                            @if ($message = Session::get('success'))
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($message = Session::get('error'))
                        <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{{ $message }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                    <p>Enter Code</p>
                    <div class="form-group">
                        <div class="col-md-6  mx-auto ">
                            <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 mx-auto ">
                            <button type="submit" class="btn btn-success  w-100">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
                <div class="col-md-8 mx-auto">
                   <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-link btn btn-primary text-white" href="{{ route('otp.resend') }}">Resend Code ?</a>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('logout') }}">
                          @csrf   
                          <button type="submit" class="btn btn-link btn btn-primary text-white">
                          Sign Out ?</button>
                      </form>
                  </div>  
              </div>                       

          </div>

      </div>
  </div>
</div>
</div>
</div>
</body>
</html>
