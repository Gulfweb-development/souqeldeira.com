<div>
    <div class="second-footer">
        <div class="container">
            <p>@lang('app.copyrights')</p>
            <span>@lang('app.app_name')</span>
            <ul class="netsocials">
                @if($setting->facebook)
                    <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                @endif
                @if($setting->twitter)
                    <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                @endif
                @if($setting->instagram)
                    <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                @endif
                @if($setting->youtube)
                    <li><a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
