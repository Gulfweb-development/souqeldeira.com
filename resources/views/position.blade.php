<div class="row portfolio-items">
    @forelse ($positions as $position)
        <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
            <div class="project-single custom-tooltip" style="max-height: 335px;min-height: 235px;overflow: hidden;">
                @if($position->image)
                    <img src="{{ asset($position->image) }}" width="100%">
                @else
                    <div class="homes-content" style="max-height: 335px;min-height: 235px;color: #ffffff !important;background-color: #1f77ca !important;">
                        <!-- homes address -->
                        <h3 @if(isArabic(strip_tags($position->title))) class="text-right m-3" dir="rtl" @else class="text-left m-3" dir="ltr" @endif style="color: #ffffff !important;background-color: #1f77ca !important;">{{ $position->title }}</h3>
                        <p @if(isArabic(strip_tags($position->description))) class="text-right homes-address mx-3 mb-3" dir="rtl" @else class="text-left homes-address mx-3 mb-3" dir="ltr" @endif style="color: #ffffff !important;background-color: #1f77ca !important;">
                           {!! nl2br(e($position->description)) !!}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @empty
    @endforelse
</div>
