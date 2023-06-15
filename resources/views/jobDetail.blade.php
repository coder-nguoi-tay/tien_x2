@extends('layouts.index')
@section('home')
    <section id="intro">
        <div class="carousel-item active">
            <div class="carousel-background"><img src="{{ asset('asset/imags/slider/slider1.jpg') }}" alt=""></div>
        </div>
    </section>
    <section id="job-Details">
        <div class="container background-color-full-white job-Details">
            <div class="Exclusive-Product">
                <h3>{{ $job->title }}</h3>
                @if (Auth::guard('user')->check())
                    @if ($checkJobTrue == 1)
                        <a class="Apply-Now" style="background: blue; color: white">Đã ứng tuyển</a>
                    @else
                        <a class="Apply-Now" data-bs-toggle="modal" data-bs-target="#exampleModal">Ứng
                            tuyển</a>
                    @endif
                    <a class="btn-like custum-icon-love-cv"><i class="fa fa-heart icon-save-cv"
                            id="{{ $job->id . ',' . $checklove }}"></i></a>
                @else
                    <button type="button" class="Apply-Now" data-bs-toggle="modal" data-bs-target="#exampleModal">Ứng
                        tuyển</button>
                @endif

                <h6 class="font-color-orange">{{ $job->nameCompany }}</h6>
                <a href="#">Chi tiết công ty</a>
                <i class="material-icons">place</i>
                <span class="text">{{ $job->address }}</span>
            </div>
            <div class="Job-Description">
                <h4>Mô tả công việc / Trách nhiệm</h4>
                <span>{!! $job->describe !!}</span>
                </ul>
                <div class="vertical-space-20"></div>
                <h4>Yêu cầu công việc</h4>
                <p class="margin-bottom">{!! $job->candidate_requirements !!}</p>
                <div class="vertical-space-20"></div>
                <h4>Phúc lợi</h4>
                <p class="margin-bottom">{!! $job->benefit !!}</p>
            </div>
        </div>
    </section>
    <section id="resent-job-post" class="background-color-white-drak">
        <div class="vertical-space-85"></div>
        <div class="container text-center">
            <h4 class="text-left">Việc làm liên quan</h4>
            <div class="vertical-space-30"></div>
            <div class="row">
                @foreach ($rules as $item)
                    <div class="col-lg-12 col-md-12">
                        <div class="detail width-100 ">
                            <div class="media display-inline text-align-center">
                                <img src="{{ $item->logo }}" width="100" class="mr-3 ">
                                <div class="media-body text-left  text-align-center">
                                    <h6><a href="{{ route('client.detail', [$item->slug, $item->id]) }}"
                                            class="font-color-black">{{ $item->title }}</a></h6>
                                    <i class="large material-icons">account_balance</i>
                                    <span class="text">{{ $item->nameCompany }}</span>
                                    <br>
                                    <i class="large material-icons">place</i>
                                    <span class="text font-size">{{ $item->addressCompany }}</span>
                                    <div class="float-right margin-top text-align-center">
                                        <a href="#" class="part-full-time">Part Tiatton</a>
                                        <p class="date-time">{{ $item->end_job_time }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-space-20"></div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="vertical-space-60"></div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ứng tuyền {{ $job->title }}</h5>
                </div>
                <div class="modal-body">
                    <up-cv
                        :data="{{ json_encode([
                            'cv' => $cv,
                            'urlStore' => route('client.upcv'),
                            'jobId' => $job->id,
                        ]) }}">
                    </up-cv>
                </div>
            </div>
        </div>
    </div>
@endsection
