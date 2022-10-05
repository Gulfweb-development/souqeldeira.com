<div>
    <x-slot name="meta_title">@lang('app.agencies')</x-slot>
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
                @forelse ($agencies as $agency)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="image myelist">
                            <a href="{{ route('profile.agency.show',[$agency->id]) }}"><img alt="my-properties-3" src="{{ $agency->getFile() }}"
                                    class="img-fluid"></a>
                        </td>

                        <td> <a href="{{ route('profile.agency.show',[$agency->id]) }}">{{ $agency->translate('name') }}</a></td>
                        <td>{{ $agency->created_at->diffForHumans() }}</td>

                        <td class="actions">
                            <a href="{{ route('profile.agency.edit',[$agency->id]) }}" class="edit"><i class="lni-pencil"></i>@lang('app.edit')</a>
                            <a href="#" wire:click.prevent="delete({{ $agency->id }})"><i
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
                {{ $agencies->links() }}
            </nav>
        </div>
    </div>
</div>
