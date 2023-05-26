<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('invoices')</x-slot>
    <x-slot name="title">@lang('invoices')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('invoices')</li>
    </x-slot>
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="example1_length">
                                    <label>@lang('app.show')
                                        <select name="example1_length" aria-controls="example1"
                                                class="custom-select custom-select-sm form-control form-control-md"
                                                wire:model="show">
                                            {!! showOptions() !!}
                                        </select>
                                    </label>
                                    |
                                    <label>@lang('app.status')
                                        <select name="example1_length" aria-controls="example1"
                                                class="custom-select custom-select-sm form-control form-control-md"
                                                wire:model="status">
                                            <option value="all">@lang('app.all')</option>
                                            <option value="success">@lang('success')</option>
                                            <option value="failed">@lang('failed')</option>
                                            <option value="pending">@lang('pending')</option>
                                        </select>
                                    </label>
                                    |
                                    <label>@lang('app.created_at'):<input
                                            type="date" class="form-control form-control-md"
                                            wire:model.debounce.500ms="date"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="example1_filter" class="dataTables_filter d-flex justify-content-end">
                                    <label>@lang('app.search'):<input
                                            type="search" class="form-control form-control-md"
                                            placeholder="@lang('app.write_here')" aria-controls="example1"
                                            wire:model.debounce.500ms="search"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th>@lang('app.id')</th>
                                        <th>@lang('app.user')</th>
                                        <th>@lang('app.description')</th>
                                        <th>@lang('app.price')</th>
                                        <th>@lang('transaction_code')</th>
                                        <th>@lang('app.status')</th>
                                        <th>@lang('app.description')</th>
                                        <th>@lang('app.created_at')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($lists as $invoice )
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>
                                                <a href="/admin/user/{{ $invoice->user->id }}" target="_blank">
                                                    {{ $invoice->user->name }}
                                                </a>
                                            </td>
                                            <td>{{ $invoice->translate('description') }}</td>
                                            <td>{{ $invoice->price }}</td>
                                            <td>{{ $invoice->transaction_id }}</td>
                                            <td>{!! $invoice->getStatus() !!}</td>
                                            <td>{{ $invoice->description }}</td>
                                            <td title="{{ $invoice->created_at }}">{{ $invoice->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        {!! noData() !!}
                                    @endforelse

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status"
                                     aria-live="polite">@lang('app.showing') 1 to
                                    {{ $lists->count() }}
                                    @lang('app.of') {{ $lists->total() }} @lang('app.entries')</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $lists->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
</div>
