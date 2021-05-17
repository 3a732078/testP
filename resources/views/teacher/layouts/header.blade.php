
<header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo">
            <a href="index">
                @yield('headername')
            </a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <nav id="navbar" class="navbar">
            <ul>
                {{--                顯示該教授當學期所有課程--}}
                <li><a class="nav-link scrollto" href="#">Course</a></li>
                <li><a class="nav-link scrollto" href="#">Course</a></li>
                <li><a class="nav-link scrollto" href="#">Course</a></li>
                <li><a class="nav-link scrollto" href="#">Course</a></li>
                <li><a class="nav-link scrollto" href="#">Course</a></li>
                <li><a class="nav-link scrollto" href="#">Course</a></li>
                {{--                顯示該教授當學期所有課程--}}

                {{--                登出等介面--}}
                <li class="dropdown"><a href="#"><span>使用者</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                        <li><a href="#">Deep Drop Down 2</a></li>
                    </ul>
                </li>
                {{--                登出等介面--}}
            </ul>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
