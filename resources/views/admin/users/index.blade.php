@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Users</h1>
        <div class="page-header-actions">
            <add-user></add-user>
        </div>
    </div>
    <user-app></user-app>
@endsection