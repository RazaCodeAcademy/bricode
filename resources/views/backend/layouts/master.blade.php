<!DOCTYPE html>
<html lang="en">
    @include('backend.layouts.head')
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    @yield('content')
    @include('backend.layouts.footer')
    @include('backend.layouts.scripts')
</body>
</html>
