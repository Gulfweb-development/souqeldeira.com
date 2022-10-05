<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.abouts') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.about') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.about.index') }}">@lang('app.abouts')</a></li>
        <li class="breadcrumb-item active">{{ $about->translate('text') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            @if (permationTo('about_text_edit'))
                <a href="{{ route('admin.about.edit', [$about->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
            @endif

            @if (permationTo('about_text_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $about->id }})">
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
                            <td>{{ $about->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.text')</td>
                            <td>{{ $about->translate('text') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_by')</td>
                            <td>{{ $about->admin->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $about->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $about->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
