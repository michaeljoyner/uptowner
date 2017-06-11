@extends('admin.base')

@section('content')
    <form action="{{ route('password.request') }}" method="POST" class="dd-form form-horizontal form-narrow password-reset-form">
        <h2>Choose a Password</h2>
        <p>Try choose something easy to remember but difficult to guess.</p>
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email: </label>
            @if($errors->has('email'))
            <span class="error-message">{{ $errors->first('email') }}</span>
            @endif
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">New Password: </label>
            @if($errors->has('password'))
            <span class="error-message">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password_confirmation">Confirm Password: </label>
            @if($errors->has('password_confirmation'))
            <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
            @endif
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn dd-btn form-control">Reset Password</button>
        </div>
    </form>
@endsection
