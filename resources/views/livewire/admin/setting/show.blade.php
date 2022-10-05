<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.settings') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.setting') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">@lang('app.settings')</a></li>
        <li class="breadcrumb-item active">{{ $setting->translate('title') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
          @if (permationTo('setting_edit'))
                <a href="{{ route('admin.setting.edit', [$setting->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
          @endif

            {{-- <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                onclick="deleteConfirmation({{ $setting->id }})">
                <i class="fas fa-times"></i>
            </button> --}}
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
                            <td>{{ $setting->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.title')</td>
                            <td>{{ $setting->translate('title') }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.facebook')</td>
                            <td>{{ $setting->facebook }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.twitter')</td>
                            <td>{{ $setting->twitter }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.instagram')</td>
                            <td>{{ $setting->instagram }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.youtube')</td>
                            <td>{{ $setting->youtube }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.description')</td>
                            <td>{{ $setting->translate('description') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_by')</td>
                            <td>{{ $setting->admin->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $setting->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $setting->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
