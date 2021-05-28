@extends('layouts/tahome')
@section('tanav')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>課程</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">已選課程:</h6>
                @if ($count > 0)
                    @for($i = 0; $i < $count; $i++)
                        <a class="collapse-item" href="/ta/classes/@php echo $tacid[$i]; @endphp" >@php echo $tac[$i]; @endphp</a>
                    @endfor
                @endif
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->

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
            <a class="nav-link" href="/ta/course/{{$class}}">
                <i class="fas fa-fw fa-comment"></i>
                <span>與Ta聯繫</span></a>
        </li>

@endsection

