<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.blogs') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.blog') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">@lang('app.blogs')</a></li>
        <li class="breadcrumb-item active">{{ $blog->translate('title') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            @if (permationTo('blog_edit'))
                <a href="{{ route('admin.blog.edit', [$blog->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
            @endif

            @if (permationTo('blog_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $blog->id }})">
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
                            <td>{{ $blog->id }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.image')</td>
                            <td><img src="{{ $blog->getFile() }}" alt="image" class="img-thumbnail" width="80"
                                    height="80" /></td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.title')</td>
                            <td>{{ $blog->translate('title') }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.text')</td>
                            <td>{{ $blog->translate('text') }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_by')</td>
                            <td>{{ $blog->admin->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $blog->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $blog->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
\
