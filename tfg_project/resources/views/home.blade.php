@extends('layouts.app')

@section('title', __('tfg.home'))

@section('page_title', __('tfg.home'))

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col">
            <h2 class="text-center">{{ __('tfg.activity_summary') }}</h2>
        </div>
    </div>
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="ti-user"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-light">{{ $users_count }}</h3>
                            <h5 class="text-muted m-b-0">{{ __('tfg.layouts.body.users') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="ti-gallery"></i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{ $posts_count }}</h3>
                            <h5 class="text-muted m-b-0">{{ __('tfg.layouts.body.posts') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-primary"><i class="ti-comments"></i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{ $comments_count }}</h3>
                            <h5 class="text-muted m-b-0">{{ __('tfg.layouts.body.comments') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="ti-clipboard"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{ $routines_count }}</h3>
                            <h5 class="text-muted m-b-0">{{ __('tfg.layouts.body.routines') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col">
            <h2 class="text-center">{{ __('tfg.statistics') }}</h2>
        </div>
    </div>
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('tfg.posts_from_categories') }}</h4>
                    <div class="flot-chart">
                        <canvas id="post_category_chart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('tfg.routines_from_types') }}</h4>
                    <div class="flot-chart">
                        <canvas id="routine_types_chart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
@endsection

@section('js_scripts')
<!-- Chart JS -->
<script src="{{ asset('assets/plugins/Chart.js/chartjs.init.js') }}"></script>
<script src="{{ asset('assets/plugins/Chart.js/Chart.min.js') }}"></script>
<script>
    $(function() {
        new Chart(document.getElementById("post_category_chart"),
        {
            "type":"pie",
            "data":{"labels":{!! json_encode($categories_names) !!},
            "datasets":[{
                "label":"My First Dataset",
                "data":{!! json_encode($count_post) !!},
                "backgroundColor":["rgb(252, 75, 108)","rgb(30, 136, 229)","rgb(255, 178, 43)","rgb(255, 107, 11)", "rgb(235, 206, 136)", "rgb(107, 213, 0)", "rgb(5, 150, 36)", "rgb(5, 184, 176)", "rgb(5, 100, 184)", "rgb(68, 81, 239)"]}
            ]}
        });
    });
</script>

<script>
    $(function() {
        new Chart(document.getElementById("routine_types_chart"),
        {
            "type":"pie",
            "data":{"labels":{!! json_encode($routine_types_names) !!},
            "datasets":[{
                "label":"My First Dataset",
                "data":{!! json_encode($count_routine) !!},
                "backgroundColor":["rgb(252, 75, 108)","rgb(30, 136, 229)","rgb(255, 178, 43)","rgb(255, 107, 11)", "rgb(235, 206, 136)", "rgb(107, 213, 0)", "rgb(5, 150, 36)", "rgb(5, 184, 176)", "rgb(5, 100, 184)", "rgb(68, 81, 239)"]}
            ]}
        });
    });
</script>
@endsection
