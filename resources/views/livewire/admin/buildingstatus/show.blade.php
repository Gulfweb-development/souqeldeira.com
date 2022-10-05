<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.building_statuses') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.building_status') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.buildingstatus.index') }}">@lang('app.building_statuses')</a></li>
        <li class="breadcrumb-item active">{{ $buildingstatus->translate('name') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <a href="{{ route('admin.buildingstatus.edit', [$buildingstatus->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                title="@lang('app.edit')">
                <i class="fas fa-pen-square"></i>
            </a>

            <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                onclick="deleteConfirmation({{ $buildingstatus->id }})">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="card-body">
            @php
                $num = 1;
            @endphp
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>@lang('app.name')</th>
                            <th>@lang('app.value')</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.id')</td>
                            <td>{{ $buildingstatus->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.name')</td>
                            <td>{{ $buildingstatus->translate('name') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_by')</td>
                            <td>{{ $buildingstatus->admin->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $buildingstatus->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $buildingstatus->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
