<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.companies') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.company') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">@lang('app.companies')</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <a href="{{ route('admin.company.edit', [$user->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                title="@lang('app.edit')">
                <i class="fas fa-pen-square"></i>
            </a>

            <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                onclick="deleteConfirmation({{ $user->id }})">
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
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.image')</td>
                            <td><img src="{{ $user->getFile() }}" alt="image" class="img-thumbnail" width="80"
                                    height="80" /></td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.name')</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                          <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.email')</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                           <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.phone')</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
   <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.is_approved')</td>
                            <td>  <span class="badge badge-{{ $user->approved_badge }}" wire:click.prevent="toggleApprove('{{ $user->is_approved }}','{{ $user->id}}')">{{ $user->approved }}</span></td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
\
