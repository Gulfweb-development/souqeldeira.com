<div>
    <x-slot name="meta_title">@lang('app.ads')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th class="pl-2">@lang('app.id')</th>
                    <th>@lang('app.description')</th>
                    <th>@lang('app.price')</th>
                    <th>@lang('transaction_code')</th>
                    <th>@lang('app.status')</th>
                    <th>@lang('app.created_at')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->translate('description') }}</td>
                        <td>{{ $invoice->price }}</td>
                        <td>{{ $invoice->transaction_id }}</td>
                        <td>{!! $invoice->getStatus() !!}</td>
                        <td>{{ $invoice->created_at->diffForHumans() }}</td>
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
                {{ $invoices->links() }}
            </nav>
        </div>
    </div>
</div>
