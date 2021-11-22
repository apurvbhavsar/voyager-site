<footer class="mt-auto footer_main common_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <h4 class="footer_widget_title">About {{ setting('site.title') }}</h4>
                <p>{{ setting('site.description') }}</p>
            </div>
            {{-- <div class="col-md-2  col-sm-6">
                <h4 class="footer_widget_title">Pages</h4>
                <ul class="footer_widget_list">
                    @php
                    $items = menu('header', '_json');
                    @endphp
                    @foreach ($items as $item)
                        <li><a href="{{ $item->url ?? url('')  }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
            </div> --}}
            <div class="col-md-4  col-sm-6">
                <h4 class="footer_widget_title">Contact Us</h4>
                <div class="footer_contact_info">
                    <div class="footer_contact_info_item">
                        <i class="las la-map-marker"></i>
                        <div class="info">{{ setting('site.address') }}</div>
                    </div>
                    <div class="footer_contact_info_item">
                        <i class="las la-envelope"></i>
                        <div class="info"><a href="mailto:{{ setting('site.email') }}">{{ setting('site.email') }}</a></div>
                    </div>
                    <div class="footer_contact_info_item">
                        <i class="las la-phone"></i>
                        <div class="info"><a href="tel:{{ setting('site.phone') }}">{{ setting('site.phone') }}</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer_static">
            <div class="col-md-6">
                <p class="footer_coyright_text">© {{ date('Y')}} {{ setting('site.title') }} – All rights reserved.</p>
            </div>
            @if ($socials = menu('social', '_json'))
                <div class="col-md-6 text-right">
                    <ul class="footer_social">
                        @foreach ($socials as $item)
                            <li><a href="{{ $item->url }}" target="{{ $item->target }}" title="{{ $item->title }}"><i class="lab {{ $item->icon_class }}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</footer>
<!-- Footer END -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
