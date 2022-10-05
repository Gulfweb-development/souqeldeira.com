<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.schools')</x-slot>
    <x-slot name="title">@lang('app.schools')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('app.schools')</li>
    </x-slot>
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    @if (permationTo('school_create'))
                        <a href="{{ route('admin.school.create') }}" class="btn btn-primary create-btn"
                            title="@lang('app.create')">
                            <i class="las la-plus-square"></i>
                        </a>
                    @endif
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
                                            <th>@lang('app.governorate')</th>
                                            <th>@lang('app.region')</th>
                                            <th>@lang('app.phone')</th>
                                            <th>@lang('app.actions')</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($schools as $school)
                                            <tr role="row" class="odd">
                                                <td class="table-id">{{ $school->id }}</td>
                                                <td><img src="{{ $school->getFile() }}" alt="image"
                                                        class="img-thumbnail" width="80" height="80" /></td>
                                                <td>{{ $school->translate('title') }}</td>
                                                <td>{{ $school->governorate->translate('name') }}</td>
                                                <td>{{ $school->region->translate('name') }}</td>
                                                <td>{{ $school->phone }}</td>
                                                {{-- <td>{{ $school->buildingStatus->translate('name') }}</td> --}}


                                                <td>
                                                    <div class="actions">

                                                        @if (permationTo('school_view'))
                                                            <a href="{{ route('admin.school.show', [$school->id]) }}"
                                                                class="btn bg-gradient-warning btn-sm show-btn"
                                                                title="@lang('app.show')">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endif
                                                        @if (permationTo('school_edit'))
                                                            <a href="{{ route('admin.school.edit', [$school->id]) }}"
                                                                class="btn bg-gradient-info btn-sm edit-btn"
                                                                title="@lang('app.edit')">
                                                                <i class="fas fa-pen-square"></i>
                                                            </a>
                                                        @endif
                                                        @if (permationTo('school_delete'))
                                                            <button class="btn bg-gradient-danger btn-sm delete-btn"
                                                                title="@lang('app.delete')"
                                                                onclick="deleteConfirmation({{ $school->id }})">
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
                                    {{ $schools->count() }}
                                    @lang('app.of') {{ $schools->total() }} @lang('app.entries')</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $schools->links() }}
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
