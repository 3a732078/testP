
<header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="index">@yield('headername')</a></h1>
        <nav id="navbar" class="navbar">
            <li class="dropdown">
                <a href="#">
                    <h3>
                        110
                    </h3>
                    <i class="bi bi-chevron-down">學年度</i>
                </a>
                <ul>
                    <li>
                        <a href="#">Drop Down 1</a>
                    </li>
                </ul>
            </li>
        </nav>

        <!-- Uncomment below if you prefer to use an image logo -->

        <nav id="navbar" class="navbar">
            <ul>
                <li class="dropdown">
                    <a href="#">
                        <span>
                            上學期
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>
                            下學期
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                </li>
            </ul>
            <select class="form-select" aria-label="Disabled select example" disabled>
                    <option selected>課程</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <li class="dropdown">
                    <span style="color: #9fcdff">使用者</span>
                    <i class="bi bi-chevron-right"></i>
                    <ul>
                        <li><a href="#">設定</a></li>
                        <li><a href="#">登出</a></li>
                    </ul>
                </li>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->
