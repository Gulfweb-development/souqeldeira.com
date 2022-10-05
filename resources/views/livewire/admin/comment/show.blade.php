<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.comments') | @lang('app.details')</x-slot>
    <x-slot name="title">@lang('app.comment') | @lang('app.details')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.comment.index') }}">@lang('app.comments')</a></li>
        <li class="breadcrumb-item active">{{ $comment->ad->title }}</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-header">
            {{-- <a href="{{ route('admin.comment.edit', [$comment->id]) }}" class="btn bg-gradient-info btn-md edit-btn"
                title="@lang('app.edit')">
                <i class="fas fa-pen-square"></i>
            </a> --}}
@if (permationTo('comment_delete'))

                <button class="btn bg-gradient-danger btn-md delete-btn ml-2" title="@lang('app.delete')"
                    onclick="deleteConfirmation({{ $comment->id }})">
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
                            <td>{{ $comment->id }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.ad')</td>
                            <td>{{ $comment->ad->title }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.user')</td>
                            <td>{{ $comment->user->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.stars')</td>
                            <td>
                                @if ($comment->stars == 1)
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                @elseif ($comment->stars == 2)
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                @elseif ($comment->stars == 3)
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                @elseif ($comment->stars == 4)
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.text')</td>
                            <td>{{ $comment->text }}</td>
                        </tr>

                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.is_approved')</td>
                            <td> <span class="badge badge-{{ $comment->approved_badge }}"
                                    wire:click.prevent="toggleApprove('{{ $comment->is_approved }}','{{ $comment->id }}')">{{ $comment->approved }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.created_at')</td>
                            <td>{{ $comment->created_at }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ $num++ }}
                            </td>
                            <td>@lang('app.updated_at')</td>
                            <td>{{ $comment->updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
\
