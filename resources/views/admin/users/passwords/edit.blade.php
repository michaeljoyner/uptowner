@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Reset Your Password</h1>
        <div class="page-header-actions">
        </div>
    </div>
    <div class="container">
        <form action="/admin/users/passwords" method="POST" class="dd-form form-horizontal form-narrow">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                <label for="old_password">Current password: </label>
                @if($errors->has('old_password'))
                <span class="error-message">{{ $errors->first('old_password') }}</span>
                @endif
                <input type="password" name="old_password" value="{{ old('old_password') }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password: </label>
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
    </div>
@endsection
