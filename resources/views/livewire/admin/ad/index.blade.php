<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.ads')</x-slot>
    <x-slot name="title">@lang('app.ads')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('app.ads')</li>
    </x-slot>
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    {{-- <a href="{{ route('admin.ad.create') }}"  class="btn btn-primary create-btn" title="@lang('app.create')">
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
                                    |
                                    <label>@lang('app.filters')
                                        <select name="example1_length" aria-controls="example1"
                                            class="custom-select custom-select-sm form-control form-control-md"
                                            wire:model="filterApproved">
                                            {!! showApprovedFilter() !!}
                                        </select>
                                    </label>
                                    |
                                    <label>@lang('app.featured')
                                        <select name="example1_length" aria-controls="example1"
                                            class="custom-select custom-select-sm form-control form-control-md"
                                            wire:model="filterFeatured">
                                            {!! showFeaturedFilter() !!}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="example1_filter" class="dataTables_filter d-flex justify-content-end">
                                    <label>@lang('app.search'):<input type="search" class="form-control form-control-md"
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
                                            <th>#</th>
                                            <th>@lang('app.image')</th>
                                            <th>@lang('app.title')</th>
                                            <th>@lang('app.price')</th>
                                            <th>@lang('app.building_type')</th>
                                            <th>@lang('app.is_featured')</th>
                                            <th>@lang('app.is_approved')</th>
                                            <th>@lang('app.actions')</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ads as $ad)
                                            <tr role="row" class="odd">
                                                <td class="table-id">{{ $ad->id }}</td>
                                                <td><img src="{{ toAdDefaultImage($ad->getFile()) }}" alt="image" class="img-thumbnail"
                                                        width="80" height="80" /></td>
                                                <td>{{ $ad->title  }}</td>
                                                <td>{{ number_format((float)$ad->price ?? '0.5', 2) }}</td>
                                                <td>{{ $ad->buildingType->translate('name') }}</td>
                                                {{-- <td>{{ $ad->buildingStatus->translate('name') }}</td> --}}

                                                <td>
                                                    <a href="{{ route('admin.ad.featured',$ad->id) }}" >
                                                        <span class="badge badge-{{ $ad->featured_badge }}">
                                                            {{ $ad->featured }}</span>
                                                    </a>
                                                </td>
                                                <td><span class="badge badge-{{ $ad->approved_badge }}"
                                                        wire:click.prevent="toggleApprove('{{ $ad->is_approved }}','{{ $ad->id }}')">
                                                        {{ $ad->approved }}</span></td>

                                                <td>
                                                    <div class="actions">

                                                       @if (permationTo('ad_view'))
                                                            <a href="{{ route('admin.ad.show', [$ad->id]) }}"
                                                                class="btn bg-gradient-warning btn-sm show-btn"
                                                                title="@lang('app.show')">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                       @endif
                                                      @if (permationTo('ad_edit'))
                                                            <a href="{{ route('admin.ad.edit', [$ad->id]) }}"
                                                                class="btn bg-gradient-info btn-sm edit-btn"
                                                                title="@lang('app.edit')">
                                                                <i class="fas fa-pen-square"></i>
                                                            </a>
                                                      @endif
                                                       @if (permationTo('ad_delete'))
                                                            <button class="btn bg-gradient-danger btn-sm delete-btn"
                                                                title="@lang('app.delete')"
                                                                onclick="deleteConfirmation({{ $ad->id }})">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                       @endif

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
                                    {{ $ads->count() }}
                                    @lang('app.of') {{ $ads->total() }} @lang('app.entries')</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $ads->links() }}
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
