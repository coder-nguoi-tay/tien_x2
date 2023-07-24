@extends('layouts.index')
@section('home')
    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-featured-sec">
                            <div class="new-slide">
                                <img src="{{ asset('home/images/resource/vector-1.png') }}">
                            </div>
                            <div class="scroll-to">
                                <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="scroll-here">
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <span>Tìm thấy {{ count($job) }} công việc</span>
                        </div><!-- Heading -->
                        <div class="job-listings-sec" id="paginated-list">
                            @foreach ($job as $item)
                                <div class="job-listing render-job-search">
                                    <div class="job-title-sec">
                                        <div class="c-logo"> <img src="{{ asset($item->logo) }}" alt="" />
                                        </div>
                                        <h3><a href="{{ route('client.detail', [$item->slug, $item->id]) }}"
                                                title="">{{ $item->title }}</a></h3>
                                        <span>{{ $item->nameCompany }}</span>
                                    </div>
                                    <span class="job-lctn"><i class="la la-map-marker"></i>{{ $item->getlocation->name }}</span>
                                    <span class="fav-job">{{ $item->end_job_time }}</span>
                                    <span class="job-is ft">{{ $item->getTime_work->name }}</span>
                                </div><!-- Job -->
                            @endforeach
                        </div>
                        {{-- paginate --}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 job-list browse-all-cat">
                                <span class="text-center p-3 ">
                                    <div id="pagination-numbers" style="margin-bottom: 20px">
                                    </div>
                                </span>
                            </div>
                        </div>
                        {{-- end paginate --}}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
