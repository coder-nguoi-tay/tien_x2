@extends('layouts.index')
@section('home')
    <section id="intro">
        <div class="carousel-item active">
            <div class="carousel-background"><img src="{{ asset('asset/imags/slider/slider1.jpg') }}" alt=""></div>
            <div class="carousel-container">
            </div>
        </div>
    </section>

    {{-- danh muc --}}
    <section id="resent-job-post" class="background-color-white-drak">
        <div class="vertical-space-85"></div>
        <div class="container text-center">
            <div class="kq">Đã tìm thấy được {{ count($job) }} công việc phù hợp vs bạn</div>
            <h4 class="text-left">Danh mục</h4>
            <div class="vertical-space-30"></div>

            <form-search-home
                :data="{{ json_encode([
                    'lever' => $lever,
                    'experience' => $experience,
                    'wage' => $wage,
                    'skill' => $skill,
                    'timework' => $timework,
                    'profession' => $profession,
                    'majors' => $majors,
                    'location' => $location,
                    'workingform' => $workingform,
                    'request' => $request,
                    'job' => $job,
                    'datalq' => $datalq,
                ]) }}">
            </form-search-home>
        </div>
        <div class="vertical-space-60"></div>
    </section>
@endsection
