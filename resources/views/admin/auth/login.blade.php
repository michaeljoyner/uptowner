@extends('admin.base')

@section('content')
    <form action="/admin/login" method="POST" class="login-form dd-form form-horizontal form-narrow">
        {!! csrf_field() !!}
        <img class="login-logo" src="/images/logos/uptowner_logo@2x.png" alt="uptowner logo">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email: </label>
            @if($errors->has('email'))
            <span class="error-message">{{ $errors->first('email') }}</span>
            @endif
            <input type="text" name="email" value="{{ old('email') }}" class="form-control">
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password: </label>
            @if($errors->has('password'))
            <span class="error-message">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
        </div>
        <div class="secondary-login-actions form-group">
            <div class="dd-checkbox-option">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    Remember me
                </label>
            </div>
            <div class="forgot-link-box">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn form-control dd-btn">Login</button>
        </div>
    </form>
@endsection