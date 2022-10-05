<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.users')</x-slot>
    <x-slot name="title">@lang('app.users')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('app.users')</li>
    </x-slot>
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                   @if (permationTo('user_create'))
                        {{-- <a href="{{ route('admin.user.create') }}" class="btn btn-primary create-btn"
                            title="@lang('app.create')">
                            <i class="las la-plus-square"></i>
                        </a> --}}
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
                                    |
                                    <label>@lang('app.types')
                                        <select name="example1_length" aria-controls="example1"
                                            class="custom-select custom-select-sm form-control form-control-md"
                                            wire:model="type">
                                            <option value="">@lang('app.all')</option>
                                            <option value="USER">@lang('app.users')</option>
                                            <option value="COMPANY">@lang('app.companies')</option>
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
                                            <th>@lang('app.name')</th>
                                            <th>@lang('app.email')</th>
                                            <th>@lang('app.phone')</th>
                                            <th>@lang('app.type')</th>
                                            <th>@lang('app.is_approved')</th>
                                            <th>@lang('app.is_featured')</th>
                                            <th>@lang('app.actions')</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr role="row" class="odd">
                                                <td class="table-id">{{ $user->id }}</td>
                                                <td><img src="{{ $user->getFile() }}" alt="image"
                                                        class="img-thumbnail" width="80" height="80" /></td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->type }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $user->approved_badge }}"
                                                        wire:click.prevent="toggleApprove('{{ $user->is_approved }}','{{ $user->id }}')">{{ $user->approved }}</span>
                                                </td>
                                                <td>
                                                    @if ($user->type == 'COMPANY')
                                                        <span class="badge badge-{{ $user->featured_badge }}"  wire:loading.attr="disabled" wire:click.prevent="toggleFeaturedActions({{ $user->is_featured }},{{ $user->id }})"> {{ $user->featured }}</span>
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="actions">

                                                      @if (permationTo('user_view'))
                                                            <a href="{{ route('admin.user.show', [$user->id]) }}"
                                                                class="btn bg-gradient-warning btn-sm show-btn"
                                                                title="@lang('app.show')">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                      @endif
                                                       @if (permationTo('user_edit'))
                                                            <a href="{{ route('admin.user.edit', [$user->id]) }}"
                                                                class="btn bg-gradient-info btn-sm edit-btn"
                                                                title="@lang('app.edit')">
                                                                <i class="fas fa-pen-square"></i>
                                                            </a>
                                                       @endif
                                                        @if (permationTo('user_delete'))
                                                            <button class="btn bg-gradient-danger btn-sm delete-btn"
                                                                title="@lang('app.delete')"
                                                                onclick="deleteConfirmation({{ $user->id }})">
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
                                    {{ $users->count() }}
                                    @lang('app.of') {{ $users->total() }} @lang('app.entries')</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $users->links() }}
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
