<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.users') | Analytics</x-slot>
    <x-slot name="title">@lang('app.user') | Analytics</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">@lang('app.users')</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            @if (permationTo('user_edit'))
                <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                   title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
            @endif

            @if (permationTo('user_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                        onclick="deleteConfirmation({{ $user->id }})">
                    <i class="fas fa-times"></i>
                </button>
            @endif

            <a href="{{ route('admin.invoices.index', ['user_id' => $user->id]) }}"
               class="btn bg-gradient-secondary btn-md show-btn ml-2"
               title="@lang('invoices')">
                <i class="fas fa-dollar-sign"></i>
            </a>
            <a href="{{ route('admin.user.subscription', ['user' => $user->id]) }}"
               class="btn bg-gradient-secondary btn-md show-btn ml-2"
               title="@lang('app.subscriptions')">
                <i class="fas fa-th"></i>
            </a>
            <a href="{{ route('admin.positions.index', ['user_id' => $user->id]) }}"
               class="btn bg-gradient-secondary btn-md show-btn ml-2"
               title="@lang('premium_position')">
                <i class="fas fa-star"></i>
            </a>
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
                        <td>Total Number of Ads Details View</td>
                        <td>{{ number_format($analytics['TotalAdsDetailsView']) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $num++ }}
                        </td>
                        <td>Total Number of Ads List View</td>
                        <td>{{ number_format($analytics['TotalAdsListView']) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $num++ }}
                        </td>
                        <td>Total Number of Phone Clicks</td>
                        <td>{{ number_format($analytics['TotalAdsPhoneClicks']) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $num++ }}
                        </td>
                        <td>Total Number of Whatsapp Click</td>
                        <td>{{ number_format($analytics['TotalAdsWhatsappClicks']) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $num++ }}
                        </td>
                        <td>Total Number of Office View</td>
                        <td>{{ number_format($analytics['TotalOfficeView']) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $num++ }}
                        </td>
                        <td>Total Number of office listing</td>
                        <td>{{ number_format($analytics['TotalOfficeListing']) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $num++ }}
                        </td>
                        <td>Top Area Listing</td>
                        <td>
                            <ol>
                                @forelse( $analytics['popularRegin'] as $areas)
                                    <li> {{ optional($areas->governorate)->name_en }} {{ number_format($areas->num) }} Ads.</li>
                                @empty
                                    <li>No Ads</li>
                                @endforelse
                            </ol>
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
