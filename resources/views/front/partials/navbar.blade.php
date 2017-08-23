<div class="hidden main-navbar flex flex-spaced bg-col sticky-top flex-center-y pr-5">
    <div class="nav-branding flex-static flex flex-center pl-7">
        <a href="/"><img src="/images/logos/logo_white.svg" class="hover-shake" alt="Uptowner Taichung Logo"
                         width="150px"></a>
    </div>
    <input type="checkbox" id="nav-trigger" class="dno">
    <nav class="nav-list flex-adapt bg-col flex flex-end flex-center-y">
        <a href="/menu"
           class="nav-item uppercase h4 fw-700 text-colour-light pd-x-4 @activeclass('/menu')"
        ><span>@lang('navbar.menu')</span></a>
        <a href="/events"
           class="nav-item uppercase h4 fw-700 text-colour-light pd-x-4 @activeclass('/events')"
        ><span>@lang('navbar.events')</span></a>
        <a href="/contact"
           class="nav-item uppercase h4 fw-700 text-colour-light pd-x-4 @activeclass('/contact')"
        ><span>@lang('navbar.contact')</span></a>
        <a href="{{ app()->getLocale() === 'en' ? Loc::getLocalizedURL('zh', null, [], true) : Loc::getLocalizedURL('en', null, [], true) }}"
           class="nav-item uppercase h4 fw-700 text-colour-light pd-x-4"
        ><span>@lang('navbar.language')</span></a>
        <label for="nav-trigger"
               class="nav-item mobile-only-block uppercase h4 fw-700 text-colour-light pd-x-4"
        ><span>@lang('navbar.close')</span></label>
    </nav>
    <label for="nav-trigger" class="text-colour-light pr-7 mobile-only-block">@include('svgicons.hamburger')</label>
</div>