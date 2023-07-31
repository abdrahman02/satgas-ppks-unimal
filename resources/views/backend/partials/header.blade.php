<!--**********************************
            Nav header start
        ***********************************-->
<div class="nav-header">
    <div class="brand-logo">
        <a href="/dashboard" class="d-flex justify-content-center">
            <b class="logo-abbr"><img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="" /> </b>
            <span class="logo-compact">
                <img src="{{ asset('img/Logo-Tut-Wuri-Handayani.png') }}" alt="" />
            </span>
            <span class="brand-title">
                <img src="{{ asset('img/Logo-Tut-Wuri-Handayani.png') }}" alt="" style="width: 40px;" />
                <img src="{{ asset('img/logo_unimal_1.png') }}" alt="" style="width: 40px;" />
                <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="" style="width: 40px;" />
            </span>
        </a>
    </div>
</div>
<!--**********************************
            Nav header end
        ***********************************-->

<!--**********************************
            Header start
        ***********************************-->
<div class="header">
    <div class="header-content clearfix">
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="{{ asset('img/default-profile.jpg') }}" height="40" width="40">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="{{ route('profile.index') }}"><i class="icon-user"></i>
                                        <span>Profile</span></a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="icon-key"></i> <span>Logout</span>
                                        <form action="{{ route('logout') }}" method="post" id="logout-form"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
            Header end ti-comment-alt
        ***********************************-->