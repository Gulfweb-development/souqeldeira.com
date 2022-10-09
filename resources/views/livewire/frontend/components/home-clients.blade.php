<div>
          <!-- STAR SECTION PARTNERS -->
        <div class="partners bg-white-3">
            <div class="container">
                <div class="sec-title">
                    <h2>@lang('app.out_clients')</h2>
                    {{-- <p>Link kw</p> --}}
                </div>
                <div class="owl-carousel style2">
                  @forelse ($clients as $client)
                        <div class="owl-item" data-aos="fade-up"><img src="{{ $client->getFile() }}" ></div>
                  @empty
                  {!! noData() !!}
                  @endforelse
                </div>
            </div>
        </div>
        <!-- END SECTION PARTNERS -->
</div>
