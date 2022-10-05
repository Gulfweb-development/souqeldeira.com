<div>
    <x-slot name="meta_title">@lang('app.contact_messages') | @lang('app.details')</x-slot>
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
                    <td>@lang('app.title')</td>
                    <td>{{ $message->translate('title') }}</td>
                </tr>



                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.message')</td>
                    <td>{{ $message->translate('message') }}</td>
                </tr>
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>@lang('app.created_at')</td>
                    <td>{{ $message->created_at->diffForHumans() }}</td>
                </tr>



            </tbody>
        </table>
        <div class="pagination-container">


        </div>
    </div>
</div>
