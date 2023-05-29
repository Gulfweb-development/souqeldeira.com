<div>
    <x-slot name="meta_title">@lang('premium_position')</x-slot>
    <div class="my-properties">
        @if(count($myPositions) > 0 )
        <table class="table-responsive mb-5">
            <thead>
                <tr>
                    <th>@lang('#')</th>
                    <th>@lang('position')</th>
                    <th>@lang('type')</th>
                    <th>@lang('app.details')</th>
                    <th>@lang('expired_at')</th>
                    <th>@lang('action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($myPositions as $position)
                    <tr>
                        <td style="padding-left: 30px;">{{ $position->id }}</td>
                        <td>@lang('position') {{ $position->position +  1 }} </td>
                        <td>@if($position->image) @lang('image') @else @lang('text') @endif</td>
                        <td>@if($position->image)
                                <img src="{{ asset($position->image) }}" style="max-width: 95px;">
                            @else
                                {{ $position->title }}
                            @endif
                        </td>
                        <td>{{  $position->expired_at->diffForHumans() }}</td>
                        <td><a href="{{ route('profile.positions.edit' , [$position->id]) }}" class="btn text-white btn-primary text-center">@lang('app.edit')</a></td>
                    </tr>
                @empty
                    <tr>
                        {!! noData() !!}
                    </tr>
                @endforelse
            </tbody>
        </table>
        @endif
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>@lang('#')</th>
                    <th>@lang('position')</th>
                    <th>@lang('app.price')</th>
                    <th>@lang('expired_at')</th>
                    <th>@lang('action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($positions as $position_num => $position)
                    <tr>
                        <td style="padding-left: 30px;">{{ $loop->iteration }}</td>
                        <td>@lang('position') {{ $position_num +  1 }} </td>
                        <td>{{ $position['price'] }} @lang('app.currency')</td>
                        <td>{{ $position['expire'] }} @lang('day')</td>
                        <td><a href="{{ route('profile.positions.buy' , [$loop->index]) }}" class="btn text-white btn-primary text-center">@lang('buy')</a></td>
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
