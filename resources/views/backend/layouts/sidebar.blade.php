<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('public/app-assets/images/logo/bricode-logo.png') }}" width="120px" />
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ current_route() == 'admin.dashboard' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'listAdmins' || Route::currentRouteName() == 'editUser' || Route::currentRouteName() == 'viewUser' || Route::currentRouteName() == 'subAdminListUsers'  || Route::currentRouteName() == 'subAdminEditUser' || Route::currentRouteName() == 'subAdminViewUser') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Users</span></a>
                <ul class="menu-content">
                    <li class="{{ current_route() == 'listAdmins' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route("listAdmins") }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                    <li class="{{ current_route() == 'createUser' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route("createUser") }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'manage-account-types.index' || Route::currentRouteName() == 'manage-account-types.create' || Route::currentRouteName() == 'manage-account-types.edit') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="user-plus"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Account Types</span></a>
                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'manage-account-types.index' || Route::currentRouteName() == 'manage-account-types.edit') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route("manage-account-types.index") }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'manage-account-types.create') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route("manage-account-types.create") }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ (Route::currentRouteName() == 'manage-payment-methods.index' || Route::currentRouteName() == 'manage-payment-methods.create' || Route::currentRouteName() == 'manage-payment-methods.edit') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Invoice">Payment Methods</span></a>
                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'manage-payment-methods.index' || Route::currentRouteName() == 'subAdminListCandidate')  ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('manage-payment-methods.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'manage-payment-methods.create') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('manage-payment-methods.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'manage-transaction.index') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="dollar-sign"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Transaction</span></a>
                <ul class="menu-content">
                    <li class="{{ current_route() == 'manage-transaction.index' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('manage-transaction.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ (Route::currentRouteName() == 'manage-withdraw.index') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Withdraw</span></a>
                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'manage-withdraw.index' || Route::currentRouteName() == 'subAdminListCandidate')  ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('manage-withdraw.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ (Route::currentRouteName() == 'manage-request.index') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="message-circle"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Requests</span></a>
                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'manage-request.index' || Route::currentRouteName() == 'subAdminListCandidate')  ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('manage-request.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ (Route::currentRouteName() == 'manage-feedback.index') ? 'open' : '' }}"><a class="d-flex align-items-center" href="#"><i data-feather="edit"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Feedback</span></a>
                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'manage-feedback.index' || Route::currentRouteName() == 'subAdminListCandidate')  ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('manage-feedback.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
