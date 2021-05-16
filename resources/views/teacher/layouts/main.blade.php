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
<section id="hero" class="d-flex align-items-start justify-content-start">
    <div class="container position-relative">
        <h1>Welcome to Enote</h1>
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
