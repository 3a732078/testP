<!doctype html>
<html lang="en">

@include('layouts.teacher.head')

<body id = "page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Side bar -->
    @include('layouts.teacher.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('layouts.teacher.topbar')

            <!-- content -->
            @yield('content')

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('notice')
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
@include('layouts.teacher.bottom')

</body>

</html>
