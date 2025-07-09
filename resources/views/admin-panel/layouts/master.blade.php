<!doctype html>
<html lang="en">


<!-- Mirrored from motrila.iranneginhotel.ir/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Dec 2019 09:28:36 GMT -->
<head>
@include('admin-panel.layouts.head-tag')
 @yield('head-tag')
</head>

<body style="background:white">
@include('admin-panel.layouts.preloader')

@include('admin-panel.layouts.settings')

<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
<div class="ecaps-page-wrapper">
    @include('admin-panel.layouts.sidebar')
    <div class="ecaps-page-content">
        @include('admin-panel.layouts.header')
    @yield('content')
</div>
</div>

@include('admin-panel.layouts.script')
@stack('script')
</body>

<!-- Mirrored from motrila.iranneginhotel.ir/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Dec 2019 09:29:53 GMT -->
</html>
