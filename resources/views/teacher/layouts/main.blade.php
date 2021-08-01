<!DOCTYPE html>
<html lang="zh_TW">

{{-- head --}}
@include('teacher.layouts.head')
{{-- End head --}}

<body>
<!-- ======= Header ======= -->
@include('teacher.layouts.header')
<!-- End Header -->

<main id="main">
    @yield('content')
</main><!-- End #main -->

<!-- ======= Footer ======= -->
@include('teacher.layouts.footer')
<!-- End Footer -->

<!-- ======= bottom ======= -->
@include('teacher.layouts.bottom')
<!-- End bottom -->

</body>

</html>
