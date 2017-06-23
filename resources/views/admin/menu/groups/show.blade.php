@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">{{ $group->name }}</h1>
        <div class="page-header-actions">
            <menu-item-form url="/admin/menu/groups/{{ $group->id }}/items"></menu-item-form>
        </div>
    </div>
    <menu-item-app group-id="{{ $group->id }}"></menu-item-app>
@endsection