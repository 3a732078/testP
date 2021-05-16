<!DOCTYPE html>
<html lang="en">

{{-- head --}}
@include('teacher.layouts.head')
{{-- End head --}}
<body>

<!-- ======= Header ======= -->
@include('teacher.layouts.header')
<!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container position-relative">
        <h1>Welcome to Baker</h1>
        <h2>We are team of talented designers making websites with Bootstrap</h2>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
</section>
<!-- End Hero -->

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
