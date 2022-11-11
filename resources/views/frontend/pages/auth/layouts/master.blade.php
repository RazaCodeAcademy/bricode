<!DOCTYPE html>
<html lang="en">
    @include('frontend.pages.auth.layouts.head')
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    {{-- @include('frontend.pages.auth.layouts.header') --}}
    @yield('content')
    @include('frontend.pages.auth.layouts.scripts')
</body>
</html>
