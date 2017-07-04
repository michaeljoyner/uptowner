@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Specials</h1>
        <div class="page-header-actions">
            <special-form form-type="create" url="/admin/specials"></special-form>
        </div>
    </div>
    <special-app></special-app>
@endsection