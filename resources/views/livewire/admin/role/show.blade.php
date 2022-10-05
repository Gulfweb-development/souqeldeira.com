<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.roles') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.role') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">@lang('app.roles')</a></li>
        <li class="breadcrumb-item active">{{ $role->translate('label') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
           @if (permationTo('role_edit');)
                <a href="{{ route('admin.role.edit', [$role->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
           @endif

          @if (permationTo('role_delete');)
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $role->id }})">
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
                            <td>{{ $role->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.label')</td>
                            <td>{{ $role->translate('label') }}</td>
                        </tr>


                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $role->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $role->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
                {{-- <hr>
                <h3 class="text-center">@lang('app.permations')</h3>
                <hr>
                <div>
                    <div class="row d-flex justify-content-center align-items-center flex-wrap">
                        @forelse ($role->permations as $permation)
                            <div class="mb-4">
                                 - <span class="badge badge-primary p-2 lead font-weight-bolder">{{ $permation->name }}</span> -
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

</div>
