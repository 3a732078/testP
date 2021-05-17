<!DOCTYPE html>
<html lang="zh_TW">

{{-- head --}}
@include('teacher.layouts.head')
{{-- End head --}}
<body>

<!-- ======= Header ======= -->
@include('teacher.layouts.header')
<!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="main" class="d-flex align-items-start justify-content-start">
    <div class="col-lg-6 col-m col-2 d-flex align-items-center justify-content-center ">
        <h1 class="">
            Welcome to Enote
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    110學年度
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
        </h1>
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
