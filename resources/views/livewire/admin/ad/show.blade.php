<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.ads') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.ad') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ad.index') }}">@lang('app.ads')</a></li>
        <li class="breadcrumb-item active">{{ $ad->title }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            @if (permationTo('ad_edit'))
                <a href="{{ route('admin.ad.edit', [$ad->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
            @endif

            @if (permationTo('ad_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $ad->id }})">
                    <i class="fas fa-times"></i>
                </button>
            @endif
        </div>
        <div class="card-body">
            @php
                $num = 1;
            @endphp
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>@lang('app.name')</th>
                            <th>@lang('app.value')</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.id')</td>
                            <td>{{ $ad->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.image')</td>
                            <td><img src="{{ toAdDefaultImage($ad->getFile()) }}" alt="image" class="img-thumbnail" width="80"
                                    height="80" /></td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.user')</td>
                            <td>{{ $ad->user->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.type')</td>
                            <td>{{ $ad->type }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.governorate')</td>
                            <td>{{ $ad->governorate->translate('name') }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.region')</td>
                            <td>{{ $ad->region->translate('name') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.building_type')</td>
                            <td>{{ $ad->buildingType->translate('name') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.title')</td>
                            <td>{{ $ad->title }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.price')</td>
                            <td>{{ number_format($ad->price, 2) }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.phone')</td>
                            <td>
                                {{ $ad->phone }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.text')</td>
                            <td @if(isArabic(strip_tags($ad->text))) class="text-right" dir="rtl" @else class="text-left" dir="ltr" @endif>{!! $ad->text!!}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.views')</td>
                            <td>
                                {{ $ad->views }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.is_featured')</td>
                            <td>
                                <span class="badge badge-{{ $ad->featured_badge }}"> {{ $ad->featured }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.is_approved')</td>
                            <td>
                                <span class="badge badge-{{ $ad->approved_badge }}"
                                    wire:click.prevent="toggleApprove('{{ $ad->is_approved }}','{{ $ad->id }}')">
                                    {{ $ad->approved }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.code')</td>
                            <td>{{ $ad->code }}</td>
                        </tr>


                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $ad->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $ad->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.archived_at')</td>
                            <td>{{ $ad->archived_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
