<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.schools') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.ad') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.school.index') }}">@lang('app.schools')</a></li>
        <li class="breadcrumb-item active">{{ $school->translate('title') }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
          @if (permationTo('school_edit'))
                <a href="{{ route('admin.school.edit', [$school->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
          @endif

           @if (permationTo('school_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $school->id }})">
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
                            <td>{{ $school->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.image')</td>
                            <td><img src="{{ $school->getFile() }}" alt="image" class="img-thumbnail" width="80"
                                    height="80" /></td>
                        </tr>


                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.governorate')</td>
                            <td>{{ $school->governorate->translate('name') }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.region')</td>
                            <td>{{ $school->region->translate('name') }}</td>
                        </tr>


                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.title')</td>
                            <td>{{ $school->translate('title') }}</td>
                        </tr>

                              <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.phone')</td>
                            <td>
                               {{ $school->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.email')</td>
                            <td>{{ $school->email }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.facebook')</td>
                            <td>{{ $school->facebook }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.twitter')</td>
                            <td>{{ $school->twitter }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.instagram')</td>
                            <td>{{ $school->instagram }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.snapchat')</td>
                            <td>{{ $school->snapchat }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.youtube')</td>
                            <td>{{ $school->youtube }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.text')</td>
                            <td>{{ $school->translate('text') }}</td>
                        </tr>


                         <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.map_link')</td>
                            <td>
                                <a href="{{ $school->map_link }}" target="_blank">
                                    {!! $school->map_link !!}
                                </a>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $school->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $school->updated_at }}</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
