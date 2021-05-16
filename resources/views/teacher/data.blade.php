@extends('teacher.layouts.main')

@section('headername')
    {{-- 直接寫入 --}}
    #
@endsection

@section('title')
    Enote
@endsection


@section('content')

    <!-- =======  Section test title======= -->
    <section id="testtitle" class="clients section-bg">
        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <h1>
                        110學年度下學期
                    </h1>
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <h1>
                        course
                    </h1>
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/clients/client-3.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/clients/client-4.png')}}" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section>
    <!-- End Title Section -->

    <!-- ======= Content Section ======= -->
    <section id="testbody" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <h3>Voluptatem dignissimos provident quasi</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <i class="bx bx-receipt"></i>
                            <h4>Corporis voluptates sit</h4>
                            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                        </div>
                        <div class="col-md-6">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Ullamco laboris nisi</h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Section -->
{{--下學期--}}
    <hr>
{{----------------------------------------------------------------------------------------------------------------}}
{{--  上學期  --}}
    <!-- =======  Section test title======= -->
    <section id="testtitle" class="clients section-bg">
        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <h1>
                        110學年度上學期
                    </h1>
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <h1>
                        course
                    </h1>
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/clients/client-3.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/clients/client-4.png')}}" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section>
    <!-- End Title Section -->

    <!-- ======= Content Section ======= -->
    <section id="testbody" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <h3>Voluptatem dignissimos provident quasi</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <i class="bx bx-receipt"></i>
                            <h4>Corporis voluptates sit</h4>
                            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                        </div>
                        <div class="col-md-6">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Ullamco laboris nisi</h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Section -->

@endsection
