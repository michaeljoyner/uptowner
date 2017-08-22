@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Menu Categories</h1>
        <div class="page-header-actions">
            <menu-page-form url="/admin/menu/pages"></menu-page-form>
        </div>
    </div>
    <menu-page-app></menu-page-app>
@endsection