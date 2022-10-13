<div>
          <!-- STAR SECTION PARTNERS -->
        <div class="partners bg-white-3">
            <div class="container">
                <div class="sec-title">
                    <h1 style="color: #092970;text-transform: uppercase;">@lang('app.out_clients')</h1>
                    {{-- <p>Link kw</p> --}}
                </div>
                <div class="owl-carousel style2">
                  @forelse ($clients as $client)
                        <div class="owl-item" data-aos="fade-up"><img src="{{ $client->getFile() }}" alt="{{ $client['name_'.app()->getLocale()] }}" ></div>
                  @empty
                  {!! noData() !!}
                  @endforelse
                </div>
            </div>
        </div>
        <!-- END SECTION PARTNERS -->
</div>
