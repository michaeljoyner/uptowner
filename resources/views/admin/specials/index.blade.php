@extends('admin.base')

@section('content')
    <div class="dd-page-header">
        <h1 class="page-title">Specials</h1>
        <div class="page-header-actions">
            <special-form form-type="create" url="/admin/specials"></special-form>
        </div>
    </div>
    <section class="rules">
        <p class="lead">For specials to show on the site, they:</p>
        <ul>
            <li>Must be published.</li>
            <li>Must not have an end date that has already passed.</li>
        </ul>
    </section>
    <special-app></special-app>
@endsection