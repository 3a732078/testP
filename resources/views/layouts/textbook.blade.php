@extends('layouts/home')
@section('nav')
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Textbook
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseText"
           aria-expanded="true" aria-controls="collapseText">
            <i class="fas fa-fw fa-book"></i>
            <span>教材</span>
        </a>
        <div id="collapseText" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">上課教材:</h6>


                {{--                1--}}
                <a class="nav-link collapsed mh5" href="#ch1" data-toggle="collapse" style="color:black;"><span>Ch1</span></a>
                <div id="ch1" class="collapse">
                    <hr class="sidebar-divider bg-dark">
                    <a class="collapse-item" href="/textbook/1">Ch1</a>
                    <a class="collapse-item" href="#">Ch1-課程筆記</a>
                </div>

                {{--                2--}}
                <a class="nav-link collapsed mh5" href="#ch2" data-toggle="collapse" style="color:black;"><span>Ch2</span></a>
                <div id="ch2" class="collapse">
                    <hr class="sidebar-divider bg-dark">
                    <a class="collapse-item" href="#">Ch2</a>
                    <a class="collapse-item" href="#">Ch2-課程筆記</a>
                </div>
            </div>

        </div>
    </li>
@endsection
