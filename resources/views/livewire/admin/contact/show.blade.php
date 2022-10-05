<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.contacts') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.contact') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">@lang('app.contacts')</a></li>
        <li class="breadcrumb-item active">{{ $contact->full_name }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            {{-- <a href="{{ route('admin.contact.edit', [$contact->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                title="@lang('app.edit')">
                <i class="fas fa-pen-square"></i>
            </a> --}}

          @if (permationTo('contact_message_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $contact->id }})">
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
                            <td>{{ $contact->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.first_name')</td>
                            <td>{{ $contact->first_name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.last_name')</td>
                            <td>{{ $contact->last_name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.email')</td>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.message')</td>
                            <td>{{ $contact->message }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $contact->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $contact->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
