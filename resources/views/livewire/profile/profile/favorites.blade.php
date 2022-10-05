<div>
    <x-slot name="meta_title">@lang('app.favorites')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="pl-2">@lang('app.favorites')</th>
                    <th class="p-0"></th>
                    <th>@lang('app.actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($favoriteAds as $favoriteAd)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="image myelist">
                            <a target="_blank" href="{{ route('ad.search', [toSlug($favoriteAd->ad->title), $favoriteAd->ad_id]) }}"><img alt="my-properties-3" src="{{ $favoriteAd->ad->getFile() }}"
                                    class="img-fluid"></a>
                        </td>
                        <td>
                            <div class="inner">
                                <a target="_blank" href="{{ route('ad.search', [toSlug($favoriteAd->ad->title), $favoriteAd->ad_id]) }}">
                                    <h2>{{ $favoriteAd->ad->title }}</h2>
                                </a>
                                <figure><i class="lni-map-marker"></i> {{ $favoriteAd->ad->governorate->translate('name') }} -
                                    {{ $favoriteAd->ad->region->translate('name') }}</figure>
                                <ul class="starts text-left mb-0">
                                    @php
                                        if ($favoriteAd->ad->comments()->count() > 0) {
                                            $stars = round($favoriteAd->ad->comments()->sum('stars') / $favoriteAd->ad->comments()->count());
                                        }else {
                                            $stars = 0;
                                        }

                                    @endphp
                                    @if ($stars == 0)

                                    @elseif ($stars == 1)
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                    @elseif ($stars == 2)
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                    @elseif ($stars == 3)
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                    @elseif ($stars == 4)
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                    @else
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                        <li class="mb-0"><i class="fa fa-star"></i>
                                        </li>
                                    @endif

                                    <li class="ml-3">({{ $favoriteAd->ad->comments()->count() }} @lang('app.reviews'))
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td class="actions d-flex justify-content-start align-items-center">
                            <a href="javascript:void(0);" wire:click.prevent="deleteFromFavorite({{ $favoriteAd->ad_id }})"><i
                                    class="far fa-trash-alt mt-5"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        {!! noData() !!}
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-container">

            <nav>
                {{ $favoriteAds->links() }}
            </nav>
        </div>
    </div>
</div>
