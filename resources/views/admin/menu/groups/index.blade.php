@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Our Menu</h1>
        <div class="page-header-actions">
            <add-menu-group></add-menu-group>
        </div>
    </div>
    <menu-group-app></menu-group-app>
@endsection