<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.faq') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.faq') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">@lang('app.faqs')</a></li>
        <li class="breadcrumb-item active">@lang('app.create')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.question_ar" label="{{ __('app.question_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.question_en" label="{{ __('app.question_en') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.answer_ar" label="{{ __('app.answer_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.answer_en" label="{{ __('app.answer_en') }}" />
                </div>



                <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
                    <button type="button" class="btn bg-gradient-primary btn-flat mt-4" wire:loading.attr="disabled"
                        wire:click.prevent="store">
                        <i class="far fa-save"></i>
                        @lang('app.save')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
