@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Upcoming Events</h1>
        <div class="page-header-actions">
            <event-form url="/admin/events"></event-form>
        </div>
    </div>
    <event-app></event-app>
@endsection