<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/teacher">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-sticky-note"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Elearning</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
{{--                <div class="sidebar-heading">--}}
{{--                    Interface--}}
{{--                </div>--}}

<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>課程</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">已選課程:</h6>

                @php
                    $courses = \App\Models\Teacher::where(
                        'user_id',\Illuminate\Support\Facades\Auth::user()->id)-> first() ->courses() -> get();
                @endphp
                @if ($courses -> count() > 0)
                    @foreach($courses as $course)
                        <a class="collapse-item" href="/classes/{{ $course->id }}" >{{$course -> name}}</a>
                    @endforeach
                @endif

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>筆記專區</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">筆記相關資訊:</h6>
                <a class="collapse-item" href="/notes/create">新增筆記</a>
                <a class="collapse-item" href="{{route('notes.mynotes')}}">我的筆記</a>
                <a class="collapse-item" href="{{route('notes.search')}}">搜尋筆記</a>
                <a class="collapse-item" href="#">收藏筆記</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#textbooks"
           aria-expanded="true" aria-controls="textbookss">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>教材</span>
        </a>
        <div id="textbooks" class="collapse" aria-labelledby="textbooks"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">教材相關:</h6>
                <a class="collapse-item" href="/textbooks/create">新增教材</a>
                <a class="collapse-item" href="/textbooks">教材管理</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Message
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-comment"></i>
            <span>與Ta聯繫</span></a>
    </li>
</ul>
