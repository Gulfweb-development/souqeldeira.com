<div>
 <x-slot name="meta_title">@lang('app.about_us')</x-slot>
    <x-slot name="meta_descrption">{{ Str::limit(strip_tags($about->translate('text')), 155)  }}</x-slot>
    <x-slot name="og_title">@lang('app.about_us')</x-slot>
    <x-slot name="og_description">{{ Str::limit(strip_tags($about->translate('text')), 155)  }}</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.about_us')</x-slot>
    <x-slot name="twitter_description">{{ Str::limit(strip_tags($about->translate('text')), 155)  }}</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.about_us')</x-slot>
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.about_us')</h1>
                <h2><a href="{{ url('/') }}">@lang('app.home') </a> &nbsp;/&nbsp; @lang('app.about_us')</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION ABOUT -->
    <section class="about-us fh">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 who-1">
                    <div>
                        <h2 class="text-left mb-4">@lang('app.about_us_title')</h2>
                    </div>
                    <div class="pftext">
                        {{ $about->translate('text') }}
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="wprt-image-video">
                        <img alt="about us" src="images/bg/bg-video.jpg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION ABOUT -->

    <!-- START SECTION WHY CHOOSE US -->
    <section class="how-it-works bg-white-2">
        <div class="container">
            <div class="sec-title">
                <h2><span>@lang('app.why_choose_us')</span></h2>
                <!--<p>@lang('app.why_choose_us_text')</p>-->
            </div>
            <div class="row service-1">
                @forelse ($whyChooseUs as $why)
                    <article class="col-lg-4 col-md-6 col-xs-12 serv">
                        <div class="serv-flex">
                            <div class="art-1 img-13">
                                <img alt="{{ $why->translate('name') }}" src="{{ $why->getFile() }}" >
                                <h3>{{ $why->translate('name') }}</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">{{ $why->translate('text') }}</p>
                            </div>
                        </div>
                    </article>
                @empty
                    {!! noData() !!}
                @endforelse

            </div>
        </div>
    </section>
    <!-- END SECTION WHY CHOOSE US -->

</div>
@section('schema2')
    {
    "@context": "http://schema.org/",
    "@type": "Organization",
    "@id": "#organization",
    "logo": {
    "@type": "ImageObject",
    "url": "{{ asset('images/logo-red.svg') }}"
    },
    "url": "{{ route('blogs') }}",
    "name": "@lang('app.blogs') {{ \App\Http\Controllers\Frontend\FrontendLangController::setting()->translate('title') }}",
    "description": ""
    }
@endsection
