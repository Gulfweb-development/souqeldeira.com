<div>
    <x-slot name="title">@lang('premium_position')</x-slot>
    <x-slot name="pageTitle">@lang('app.dashboard') | @lang('premium_position')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('premium_position')</li>
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
                                            <option value="active">@lang('active')</option>
                                            <option value="InActive">@lang('InActive')</option>
                                        </select>
                                    </label>
                                    |
                                    <label>@lang('app.status')
                                        <select name="example1_length" aria-controls="example1"
                                                class="custom-select custom-select-sm form-control form-control-md"
                                                wire:model="is_payed">
                                            <option value="all">@lang('app.all')</option>
                                            <option value="paid">@lang('paid')</option>
                                            <option value="pending">@lang('pending')</option>
                                        </select>
                                    </label>
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
                                        <th>@lang('#')</th>
                                        <th>@lang('app.user')</th>
                                        <th>@lang('position')</th>
                                        <th>@lang('type')</th>
                                        <th>@lang('is_payed')</th>
                                        <th>@lang('expired_at')</th>
                                        <th>@lang('action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($positions as $position )
                                        <tr>
                                            <td style="padding-left: 30px;">{{ $position->id }}</td>
                                            <td>
                                                <a href="/admin/user/{{ $position->user->id }}" target="_blank">
                                                    {{ $position->user->name }}
                                                </a>
                                            </td>
                                            <td>@lang('position') {{ $position->position +  1 }} </td>
                                            <td>@if($position->image) @lang('image') @else @lang('text') @endif</td>
                                            <td>
                                                {!! $position->getPaidSatatus() !!}
                                            </td>
                                            <td>{{  $position->expired_at->diffForHumans() }}</td>
                                            <td><a href="{{ route('admin.positions.edit' , [$position->id]) }}" class="btn text-white btn-primary text-center">@lang('app.edit')</a></td>
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
                                    {{ $positions->count() }}
                                    @lang('app.of') {{ $positions->total() }} @lang('app.entries')</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $positions->links() }}
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
