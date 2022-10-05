<div>
    <x-slot name="meta_title">@lang('app.managemant_messages')</x-slot>
    <div class="my-properties">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th class="pl-2">#</th>
                    <th class="p-0">@lang('app.title')</th>
                    <th>@lang('app.created_at')</th>
                    <th>@lang('app.actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td> <a href="{{ route('profile.user-message.show',[$message->id]) }}">{{ $message->translate('title') }}</a></td>
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
