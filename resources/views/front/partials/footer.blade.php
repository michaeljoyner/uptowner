<footer class="bg-pattern-orange bg-col-soft main-footer">
    <div class="grid col-3  body-text text-colour-light pd-y-7 footer-row">
        <div class="flex-col flex-center-y footer-column">
            <h4 class="h4">@lang('footer.location.heading')</h4>
            <p class="mg-y-1">@lang('footer.location.line_one')</p>
            <p class="mg-y-1">@lang('footer.location.line_two')</p>
            <p class="mg-y-1">@lang('footer.location.line_three')</p>
        </div>
        <div class="flex-col flex-center-y footer-column">
            <div  class="flex-col flex-center-y">
                <h4 class="h4">@lang('homepage.details.hours.heading')</h4>
                <p class="mg-y-1">@lang('homepage.details.hours.line_one')</p>
                <p class="mg-y-1">@lang('homepage.details.hours.line_two')</p>
            </div>
        </div>
        <div class="flex-col flex-center-y footer-column">
            <div class="flex-col flex-center-y">
                <h4 class="h4">@lang('footer.social.heading')</h4>
                <div class="pt-7">
                    <a href="https://www.facebook.com/theuptownertaichung/" class="social-icon white-icon mg-2">@include('svgicons.facebook')</a>
                    {{--<a href="#" class="social-icon white-icon mg-2">@include('svgicons.twitter')</a>--}}
                    <a href="https://www.instagram.com/uptownertaichung/" class="social-icon white-icon mg-2">@include('svgicons.instagram')</a>
                    {{--<a href="#" class="social-icon white-icon mg-2">@include('svgicons.uber_eats')</a>--}}
                    <a href="https://www.tripadvisor.com/Restaurant_Review-g297910-d7975130-Reviews-Uptowner_Taichung-Taichung.html" class="social-icon white-icon mg-2">@include('svgicons.tripadvisor')</a>
                </div>
            </div>
        </div>    
    </div>
    <img src="/images/logos/logo_white.svg" alt="Uptowner Taichung logo" class="block mg-x-a w-con-200 pb-7 hover-bob footer_logo_top_link">
    <p class="body-text text-colour-light pd-y-5 text-center">@lang('footer.copyright') &copy; @lang('footer.credit') <a href="#" class="hover-blue">Dymantic Design</a></p>
</footer>