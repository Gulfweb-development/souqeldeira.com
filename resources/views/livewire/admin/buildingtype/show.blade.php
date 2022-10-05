<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.building_types') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.building_type') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.buildingtype.index') }}">@lang('app.building_types')</a>
        </li>
        <li class="breadcrumb-item active">{{ $buildingtype->translate('name') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            @if (permationTo('building_type_edit'))
                <a href="{{ route('admin.buildingtype.edit', [$buildingtype->id]) }}"
                    class="btn bg-gradient-info btn-md edit-btn" title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
            @endif

            @if (permationTo('building_type_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $buildingtype->id }})">
                    <i class="fas fa-times"></i>
                </button>
            @endif
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
                            <td>{{ $buildingtype->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.name')</td>
                            <td>{{ $buildingtype->translate('name') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_by')</td>
                            <td>{{ $buildingtype->admin->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $buildingtype->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $buildingtype->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
