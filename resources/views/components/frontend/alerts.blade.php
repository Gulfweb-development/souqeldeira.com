<div>
    @if (Session::has($type))
        <div class="alert alert-{{ $type }}">
            <p>{{ Session::get($type) }}</p>
        </div>
    @endif
</div>
