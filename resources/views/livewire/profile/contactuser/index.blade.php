<div>
    <x-slot name="meta_title">@lang('app.contact_messages')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th class="pl-2">#</th>
                    <th class="p-0">@lang('app.image')</th>
                    <th class="p-0">@lang('app.name')</th>
                    <th>@lang('app.created_at')</th>
                    <th>@lang('app.actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="image myelist">
                            <a href="{{ route('profile.contact-user.show',[$message->id]) }}"><img alt="my-properties-3" src="{{ $message->user->getFile() }}"
                                    class="img-fluid"></a>
                        </td>

                        <td> <a href="{{ route('profile.contact-user.show',[$message->id]) }}">{{ $message->user->name }}</a></td>
                        <td>{{ $message->created_at->diffForHumans() }}</td>

                        <td class="actions">
                            <a href="#" wire:click.prevent="delete({{ $message->id }})"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        {!! noData() !!}
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-container">

            <nav>
                {{ $messages->links() }}
            </nav>
        </div>
    </div>
</div>
