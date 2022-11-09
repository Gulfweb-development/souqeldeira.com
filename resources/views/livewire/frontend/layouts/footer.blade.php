<div>

<!-- START FOOTER -->
<footer class="first-footer">
    <!---<div class="top-footer"> </div>--->
    <div class="second-footer">
        <div class="container">
            <p>@lang('app.copyrights')</p>
            <span class="footer-custom-css">SOUQELDEIRA</span>
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
</footer>

<a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
<!-- END FOOTER -->


<!-- START PRELOADER -->
<div id="preloader">
    <div id="status">
        <div class="status-mes"></div>
    </div>
</div>
<!-- END PRELOADER -->
<!-- Popup home page for car and real estat --->

</div>
