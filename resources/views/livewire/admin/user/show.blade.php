<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.users') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.user') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">@lang('app.users')</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            @if (permationTo('user_edit'))
                <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                    title="@lang('app.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
            @endif

            @if (permationTo('user_delete'))
                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $user->id }})">
                    <i class="fas fa-times"></i>
                </button>
            @endif

                <a href="{{ route('admin.invoices.index', ['user_id' => $user->id]) }}"
                   class="btn bg-gradient-secondary btn-md show-btn ml-2"
                   title="@lang('invoices')">
                    <i class="fas fa-dollar-sign"></i>
                </a>
                <a href="{{ route('admin.user.subscription', ['user' => $user->id]) }}"
                   class="btn bg-gradient-secondary btn-md show-btn ml-2"
                   title="@lang('app.subscriptions')">
                    <i class="fas fa-th"></i>
                </a>
                <a href="{{ route('admin.positions.index', ['user_id' => $user->id]) }}"
                   class="btn bg-gradient-secondary btn-md show-btn ml-2"
                   title="@lang('app.premium_position')">
                    <i class="fas fa-star"></i>
                </a>
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
                            <td>@lang('app.type')</td>
                            <td>{{ $user->type }}</td>
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
                            <td>@lang('app.type')</td>
                            <td>{{ $user->type }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.is_approved')</td>
                            <td> <span class="badge badge-{{ $user->approved_badge }}"
                                    wire:click.prevent="toggleApprove('{{ $user->is_approved }}','{{ $user->id }}')">{{ $user->approved }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.governorates')</td>
                            <td>
                                @forelse ($user->governorates as $governorate)
                                    <span class="badge badge-danger">{{ $governorate->translate('name') }}</span>
                                @empty
                                    {!! noData() !!}
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.field')</td>
                            <td>
                                <span class="badge badge-warning">{{ $user->field }}</span>
                            </td>
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
                            <td>@lang('app.description')</td>
                            <td>{{ $user->translate('description') }}</td>
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
        <h1 class="text-center text-primary">@lang('app.send_notification')</h1>
        <hr>
        @if (permationTo('notification_create'))
            <div class="col-md-12">

                <div class="form-group">
                    <label for="exampleInputadssd">@lang('app.title_en')</label>
                    <input type="text" class='form-control @error(' title_en') is-invalid @enderror'
                        id="exampleInputadssd" wire:model.defer="title_en">
                    @error('title_en')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputadssd2">@lang('app.title_ar')</label>
                    <input type="text" class='form-control @error(' title_ar') is-invalid @enderror'
                        id="exampleInputadssd2" wire:model.defer="title_ar">
                    @error('title_ar')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1mm">@lang('app.message_en')</label>
                    <textarea class="form-control @error('message_en') is-invalid @enderror" rows="3"
                        wire:model.defer="message_en" id="exampleFormControlTextarea1mm"></textarea>
                    @error('message_en')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1mm">@lang('app.message_ar')</label>
                    <textarea class="form-control @error('message_ar') is-invalid @enderror" rows="3"
                        wire:model.defer="message_ar" id="exampleFormControlTextarea1mm"></textarea>
                    @error('message_ar')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <hr>
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-primary btn-lg" wire:loading.attr="disabled"
                    wire:click.prevent="sendNotification">@lang('app.send')</button>
            </div>
        @endif
        <hr>
    </div>
</div>
