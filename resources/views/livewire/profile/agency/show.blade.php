<div>
    <x-slot name="meta_title">@lang('app.agencys') | @lang('app.details')</x-slot>
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
                    <td>{{ $agency->id }}</td>
                </tr>
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.image')</td>
                    <td><img src="{{ $agency->getFile() }}" alt="@lang('app.alt_img')" width="70" height="70" /></td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.name')</td>
                    <td>{{ $agency->translate('name') }}</td>
                </tr>

                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.text')</td>
                    <td>{{ $agency->translate('text') }}</td>
                </tr>
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.created_at')</td>
                    <td>{{ $agency->created_at->diffForHumans() }}</td>
                </tr>



            </tbody>
        </table>
        <div class="pagination-container">


        </div>
    </div>
</div>
