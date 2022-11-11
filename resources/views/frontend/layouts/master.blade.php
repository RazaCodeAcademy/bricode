<!DOCTYPE html>
<html lang="en">
    @include('frontend.layouts.head')
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    @include('frontend.layouts.header')
    @include('frontend.layouts.sidebar')
    @yield('content')
    @include('frontend.layouts.footer')
    @include('frontend.layouts.scripts')
</body>
</html>
