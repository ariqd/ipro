@extends('layouts.app')

@push("css")
    <style>
        .card {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }
    </style>
@endpush

@push("js")
    <script>
        function myFunction() {
            let x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush

@section('content')
    <div class="container w-100">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets').'/img/logo.png' }}" alt="logo ipro">
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail or Username') }}</label>
                                <div>
                                    <input id="email" type="text"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div>
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input class="custom-control-input" onclick="myFunction()" type="checkbox" value=""
                                           id="defaultCheck1">
                                    <label class="custom-control-label" for="defaultCheck1">
                                        Show Password
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-ipro btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection