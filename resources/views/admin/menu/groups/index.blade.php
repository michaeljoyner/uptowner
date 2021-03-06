@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Our Menu</h1>
        <div class="page-header-actions">
            <menu-group-form url="/admin/menu/groups"></menu-group-form>
        </div>
    </div>
    <menu-group-app></menu-group-app>
@endsection