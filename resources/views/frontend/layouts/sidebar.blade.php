<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="{{ asset('public/app-assets/images/logo/bricode-logo.png') }}" width="120px" />
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ current_route() == 'dashboard' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('dashboard') }}"><i data-feather="home"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="{{ current_route() == 'earning.history.index' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('earning.history.index') }}"><i data-feather="dollar-sign"></i><span class="menu-item text-truncate"
                        data-i18n="Add">Earning</span></a>
            </li>
            <li class="{{ current_route() == 'withdraw.index' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('withdraw.index') }}"><i data-feather="credit-card"></i><span class="menu-item text-truncate"
                        data-i18n="Add">Withdraw</span></a>
            </li>
            <li class="{{ current_route() == 'user.edit.profile' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('user.edit.profile') }}"><i data-feather="user"></i><span class="menu-item text-truncate"
                        data-i18n="Add">Profile</span></a>
            </li>
            <li class="{{ current_route() == 'feedback.create' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('feedback.create') }}"><i data-feather="edit"></i><span class="menu-item text-truncate"
                        data-i18n="Add">Feedback</span></a>
            </li>
            <li class="{{ current_route() == 'user.logout' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('user.logout') }}"><i data-feather="log-out"></i><span class="menu-item text-truncate"
                        data-i18n="Add">Logout</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
