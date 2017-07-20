@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">{{ $page->name }}</h1>
        <div class="page-header-actions">

        </div>
    </div>
    <menu-page-groups-app page-id="{{ $page->id }}"></menu-page-groups-app>
@endsection