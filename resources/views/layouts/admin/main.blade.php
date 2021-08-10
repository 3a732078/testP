<!doctype html>
<html lang="en">

@include('layouts.teacher.head')

<body id = "page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Side bar -->
@include('layouts.admin.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="">

            <!-- Topbar -->
        @include('layouts.admin.topbar')

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
