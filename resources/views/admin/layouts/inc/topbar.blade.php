<nav class="navbar">
    <div class="col-12">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('home') }}" target="_blank">{{ $website_settings->website_title ?? '' }}</a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <li><a href="{{ route('logout') }}" class="mega-menu xs-hide" data-close="true"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="zmdi zmdi-power"></i></a></li>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
            {{-- <li><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                        class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li> --}}
        </ul>
    </div>
</nav>
