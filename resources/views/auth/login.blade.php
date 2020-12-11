@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="wrapper fadeInDown">
        <div id="formContent">
         
            <div class="fadeIn first">
                <div class="card-header">{{ __('Login') }}</div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="p-5">
                    <!-- <input type="text" id="login" class="fadeIn second" name="login" placeholder="login"> -->
                    <input id="email" type="text" class="fadeIn second @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!-- <input type="password" id="password" class="fadeIn third" name="login" placeholder="password"> -->
                    <input id="password" type="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" required  placeholder="Contraseña">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div id="formFooter">
                    <input type="submit" class="fadeIn fourth" value="Iniciar">
                </div>
            </form>
        </div>
</div>
@endsection
