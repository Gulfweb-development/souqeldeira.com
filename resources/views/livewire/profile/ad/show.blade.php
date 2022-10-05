<div>
    <x-slot name="meta_title">@lang('app.ads') | @lang('app.details')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            @php
                $num = 1;
            @endphp
            <thead>
                <tr>
                    <th class="pl-2">#</th>
                    <th>@lang('app.name')</th>
                    <th>@lang('app.value')</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.id')</td>
                    <td>{{ $ad->id }}</td>
                </tr>
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.image')</td>
                    <td><img src="{{ $ad->getFile() }}" alt="@lang('app.alt_img')" width="70" height="70" /></td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.governorate')</td>
                    <td>{{ $ad->governorate->translate('name') }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.region')</td>
                    <td>{{ $ad->region->translate('name') }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.building_type')</td>
                    <td>{{ $ad->buildingType->translate('name') }}</td>
                </tr>


                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.type')</td>
                    <td>{{ $ad->type }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.status')</td>
                    <td><span class="badge badge-{{ $ad->approved_badge }}"> {{ $ad->approved }}</span></td>
                </tr>



                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.phone')</td>
                    <td>{{ $ad->phone }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.price')</td>
                    <td>{{ $ad->price }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.text')</td>
                    <td>{{ $ad->text }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.created_at')</td>
                    <td>{{ $ad->created_at->diffForHumans() }}</td>
                </tr>

            </tbody>
        </table>
        <div class="pagination-container">


        </div>
    </div>
</div>
