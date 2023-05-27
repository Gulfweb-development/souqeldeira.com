<div>
    <x-slot name="meta_title">@lang('premium_position')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>@lang('position')</th>
                    <th>@lang('app.price')</th>
                    <th>@lang('expired_at')</th>
                    <th>@lang('action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($positions as $position)
                    <tr>
                        <td style="padding-left: 30px;">{{ $loop->iteration }}</td>
                        <td>{{ $position['price'] }} @lang('app.currency')</td>
                        <td>{{ $position['expire'] }}</td>
                    </tr>
                @empty
                    <tr>
                        {!! noData() !!}
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
