<div>
    <x-slot name="meta_title">@lang('app.ads')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th class="pl-2">@lang('app.ads')</th>
                    <th class="p-0"></th>
                    <th>@lang('app.created_at')</th>
                    <th>@lang('app.status')</th>
                    <th>@lang('app.views')</th>
                    <th>@lang('app.actions')</th>
                    {{-- <th>@lang('app.payment')</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($ads as $ad)
                    <tr>
                        <td class="image myelist">
                            <a href="{{ route('profile.ad.show',[$ad->id]) }}"><img alt="my-properties-3" src="{{ $ad->getFile() }}"
                                    class="img-fluid"></a>
                        </td>
                        <td>
                            <div class="inner">
                                <a href="{{ route('profile.ad.show',[$ad->id]) }}">
                                    <h2>{{ $ad->title }}</h2>
                                </a>
                                <figure><i class="lni-map-marker"></i> {{ $ad->governorate->translate('name') }} -
                                    {{ $ad->region->translate('name') }}</figure>
                                <ul class="starts text-left mb-0">
                                    @php
                                        if ($ad->comments()->count() > 0) {
                                            $stars = round($ad->comments()->sum('stars') / $ad->comments()->count());
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

                                    <li class="ml-3">({{ $ad->comments()->count() }} @lang('app.reviews'))
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $ad->created_at->diffForHumans() }}</td>
                        <td><span class="badge badge-{{ $ad->approved_badge }}"> {{ $ad->approved }}</span></td>
                        <td>{{ $ad->views }}</td>
                        <td class="actions">
                            <a href="{{ route('profile.ad.edit',[$ad->id]) }}" class="edit"><i class="lni-pencil"></i>@lang('app.edit')</a>
                            <a href="#" wire:click.prevent="delete({{ $ad->id }})"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                        {{-- <td class="actions">
                          <button type="button" class="btn btn-common text-light" wire:click.prevent="payment"><i class="fas fa-dollar-sign"></i> @lang('app.payment')</button>
                        </td> --}}
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
                {{ $ads->links() }}
            </nav>
        </div>
    </div>
</div>
