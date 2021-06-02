
<html>
<head>
    <title>教授 教材列表</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 pt-5">
            <h1><a href="index.html" class="logo">教材列表</a></h1>
            <a href="{{url()->previous()}}" style="color:#FFFFFF"><i class="fas fa-arrow-left"></i></a>|
            <a href="/" style="color:#FFFFFF"><i class="fas fa-home home" style="color:#FFFFFF"></i>  回首頁</a>
            <ul class="list-unstyled components mb-5">
                @foreach($courses as $course)
                    <li class="active">
                        <a href="#{{$course->name}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{$course->name}}</a>
                        <ul class="collapse list-unstyled" id="{{$course->name}}">
                            @php $ctextbook=$textbooks->where('course_id',$course->id);
                            @endphp
                            @foreach($ctextbook as $textbook)
                                <li>
                                    <a href="/textbooks/{{$textbook->id}}">{{$textbook->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="/textbooks/create">新增教材</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="content" class="p-4 p-md-5 pt-5">
        @yield('teatext')
    </div>

</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/popper.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/main.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

