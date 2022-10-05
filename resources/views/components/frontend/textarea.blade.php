<div>
    @isset($label)
        <label for="">
            {{ $label }}
        </label>
    @endisset
    <textarea  name="message-{{ $name }}" wire:model.defer="{{ $name }}"></textarea>
    @error($name)
        <p class="text-danger text-sm">{{ $message }}</p>
    @enderror
</div>
