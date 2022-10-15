<div>
     <x-slot name="meta_title">@lang('app.contact_us')</x-slot>
    <x-slot name="meta_descrption">@lang('app.contact_us')</x-slot>
    <x-slot name="og_title">@lang('app.contact_us')</x-slot>
    <x-slot name="og_description">@lang('app.contact_us')</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.contact_us')</x-slot>
    <x-slot name="twitter_description">@lang('app.contact_us')</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.contact_us')</x-slot>
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.contact_us')</h1>
                <h2><a href="index.html">Home </a> &nbsp;/&nbsp; @lang('app.contact_us')</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION CONTACT US -->
    <section class="contact-us">
        <div class="container">
            <!--<div class="property-location mb-5">-->
            <!--    <h3>@lang('app.our_location')</h3>-->
            <!--    <div class="divider-fade"></div>-->
            <!--    <div class="pftext">-->
            <!--        <p>@lang('app.our_location_text')</p>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <h3 class="mb-4">@lang('app.contact_us')</h3>
                    <x-frontend.alerts type="success" />
                    <div id="success" class="successform">
                        <p class="alert alert-success font-weight-bold" role="alert">Your message was sent successfully!
                        </p>

                    </div>
                    <div id="error" class="errorform">
                        <p>Something went wrong, try refreshing and submitting the form again.</p>
                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control input-custom input-full" name="name"
                            placeholder="First Name" wire:model="state.first_name">
                        @error('first_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control input-custom input-full" name="lastname"
                            placeholder="Last Name" wire:model="state.last_name">
                        @error('last_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-custom input-full" name="email" placeholder="Email"
                            wire:model="state.email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control textarea-custom input-full" id="ccomment" name="message" required
                            rows="8" placeholder="Message" wire:model="state.message"></textarea>
                        @error('message')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="button" id="submit-contasct" class="btn btn-primary btn-lg"
                        wire:loading.attr="disabled" wire:click.prevent="send">@lang('app.submit')</button>
                </div>
                <div class="col-lg-4 col-md-12 bgc">
                    <div class="call-info text-light" wire:ignore>
                        <h3>@lang('app.contact_details')</h3>
                        <p class="mb-5">@lang('app.contact_details_text')</p>
                        {!! nl2br($info->translate('text')) !!}
                        <!--<ul>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p class="in-p">00 build., City, Country</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <p class="in-p">+123 456 789 012</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <p class="in-p ti">example@companyName.com</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info cll">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <p class="in-p ti">8:00 a.m - 9:00 p.m</p>
                                    </div>
                                </li>
                            </ul>-->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION CONTACT US -->
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
