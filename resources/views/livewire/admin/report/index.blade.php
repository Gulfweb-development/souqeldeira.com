<div>
{{--    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.reports')</x-slot>--}}
{{--    <x-slot name="title">@lang('app.reports')</x-slot>--}}
    <x-slot name="breadcrumb">
{{--        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>--}}
        <li class="breadcrumb-item active">@lang('app.reports')</li>
    </x-slot>
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    {{-- <a href="{{ route('admin.contact.create') }}"  class="btn btn-primary create-btn" title="@lang('app.create')">
                        <i class="las la-plus-square"></i>
                    </a> --}}
                </div>
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
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th width="5%">#</th>
{{--                                            <th>@lang('app.first_name') & @lang('app.last_name')</th>--}}
{{--                                            <th>@lang('app.type')</th>--}}
                                            <th width="40%">@lang('app.description')</th>
                                            <th width="35%">@lang('app.name')</th>
                                            <th width="15%">@lang('app.created_at')</th>
                                            <th width="5%">@lang('app.actions')</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reports as $report)
                                            <tr role="row" class="odd">
                                                <td class="table-id">{{ $report->id }}</td>
{{--                                                <td>{{ optional($report->user)->first_name }} {{ optional($report->user)->last_name }}</td>--}}
{{--                                                <td>{{ $report->item_type == \App\Models\Ad::class ? trans('app.ad') : trans('app.agency') }}</td>--}}
                                                <td>{!! nl2br(strip_tags($report->description)) !!}</td>
                                                <td>
                                                    @if($report->item_type == \App\Models\Ad::class)
                                                        <div class="badge badge-primary">{{trans('app.ad')}}</div>
                                                        <a target="_blank" href="{{ route( 'admin.ad.show', [$report->item_id]) }}">
                                                            {{$report->item->title}}
                                                        </a>
                                                    @else
                                                        <div class="badge badge-primary">{{trans('app.agency')}}</div>
                                                        <a target="_blank" href="{{ route( 'admin.user.show', [$report->item_id]) }}">
                                                            {{ $report->item->name }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{ $report->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <button class="btn bg-gradient-danger btn-sm delete-btn"
                                                            title="@lang('app.delete')"
                                                            onclick="deleteConfirmation({{ $report->id }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
{{--                                                        <a target="_blank" href="{{ route(( $report->item_type == \App\Models\Ad::class ?'admin.ad.show' : 'admin.user.show' ), [$report->item_id]) }}"--}}
{{--                                                           class="btn bg-gradient-warning btn-sm show-btn"--}}
{{--                                                           title="@lang('app.show')">--}}
{{--                                                            <i class="fas fa-eye"></i>--}}
{{--                                                        </a>--}}
                                                    </div>
                                                </td>
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
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    @lang('app.showing') 1 to
                                    {{ $reports->count() }}
                                    @lang('app.of') {{ $reports->total() }} @lang('app.entries')</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $reports->links() }}
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
