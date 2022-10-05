<div>
    <x-slot name="meta_title">@lang('app.profile')</x-slot>
    <div class="section-body listing-table">
        <div class="widget-boxed-header">
            <h4>@lang('app.change_password')</h4>
        </div>
        <div class="sidebar-widget author-widget2">
            <div class="author-box clearfix">
                <img src="{{ user()->getFile() }}" alt="author-image" class="author__img">
                <h4 class="author__title">{{ user()->name }}</h4>
                {{-- <p class="author__meta">Agent of Property</p> --}}
            </div>

            <div class="agent-contact-form-sidebar">
                    <x-frontend.input type="password" name="old_password" label="{{ __('app.old_password') }}" />
                    <x-frontend.input type="password" name="password" label="{{ __('app.new_password') }}" />
                    <x-frontend.input type="password" name="password_confirmation" label="{{ __('app.confirm_new_password') }}" />

                    <input type="button" name="sendmessage" class="multiple-send-message" value="@lang('app.update_password')"  wire:loading.attr="disabled" wire:click.prevent="updatePassword" />

            </div>
        </div>
    </div>
</div>
