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
                            <div class="job-search-sec">
                                <div class="job-search">
                                    <h3>The Easiest Way to Get Your New Job</h3>
                                    <span>Find Jobs, Employment & Career Opportunities</span>
                                    <form action="{{ route('home.search') }}">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-5 col-sm-12 col-xs-12">
                                                <div class="job-field">
                                                    <input type="text" name="key" class="form-control"
                                                        placeholder="Job title, keywords or company name" />
                                                    <i class="la la-keyboard-o"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                                <div class="job-field">
                                                    <select class="form-control" name="location" style="height: 62px;">
                                                        @foreach ($location as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="la la-map-marker"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                                <button type="submit"><i class="la la-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <br>
    <section id="scroll-here">
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Việc làm nổi bật</h2>
                            <span>Các nhà tuyển dụng hàng đầu đã sử dụng công việc và nhân tài.</span>
                        </div><!-- Heading -->
                        <div class="job-listings-sec" id="paginated-list">
                            @foreach ($job as $item)
                                <div class="job-listing render-job-search">
                                    <div class="job-title-sec">
                                        <div class="c-logo"> <img src="{{ asset($item->logo) }}" alt="" />
                                        </div>
                                        <h3><a href="{{ route('client.detail', [$item->slug, $item->id]) }}"
                                                title="">{{ $item->title }}</a></h3>
                                        <span><a
                                                href="{{ route('company.detail', $item->id) }}">{{ $item->nameCompany }}</a></span>
                                    </div>
                                    <span class="job-lctn"><i
                                            class="la la-map-marker"></i>{{ $item->getlocation->name }}</span>
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


    <section>
        <div class="block double-gap-top double-gap-bottom">
            <div data-velocity="-.1"
                style="background: url({{ asset('home/images/resource/parallax1.jpg') }}) repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible layer color"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text-block">
                            <h3>Make a Difference with Your Online Resume!</h3>
                            <span>Your resume in minutes with JobHunt resume assistant is ready!</span>
                            <a href="" title="">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Ngành nghề trọng điểm</h2>
                            <span>{{ $countJob }} Việc làm hiện có</span>
                        </div><!-- Heading -->
                        <div class="cat-sec">

                            <div class="row no-gape">
                                @foreach ($majors as $value)
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="p-category">
                                            <a href="{{ route('client.nganh-nghe.show', $value->id) }}" title="">
                                                <i class="{{ $value->image_majors }}"></i>
                                                <span>{{ $value->name }}</span>
                                                <p>({{ count($value->majors) }} Việc làm)</p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
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
                            <h2>Việc làm hấp dẫn</h2>
                            <span>Các nhà tuyển dụng hàng đầu đã sử dụng công việc và nhân tài.</span>
                        </div><!-- Heading -->
                        <div class="job-listings-sec" id="paginated-list">
                            @foreach ($jobAttractive as $item)
                                <div class="job-listing render-job-search">
                                    <div class="job-title-sec">
                                        <div class="c-logo"> <img src="{{ asset($item->logo) }}" alt="" />
                                        </div>
                                        <h3><a href="{{ route('client.detail', [$item->slug, $item->id]) }}"
                                                title="">{{ $item->title }}</a></h3>
                                        <span><a
                                                href="{{ route('company.detail', $item->id) }}">{{ $item->nameCompany }}</a></span>
                                    </div>
                                    <span class="job-lctn"><i
                                            class="la la-map-marker"></i>{{ $item->getlocation->name }}</span>
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
    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Các công ty đang hợp tác</h2>
                            <span>Một số công ty chúng tôi đã giúp tuyển dụng những ứng viên xuất sắc trong những năm
                                qua.</span>
                        </div><!-- Heading -->
                        <div class="comp-sec">
                            <div class="company-img">
                                @foreach ($company as $item)
                                    <a href="" title="">
                                        <img src="{{ asset($item->logo) }}" alt="" width="100" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div data-velocity="-.1"
                style="background: url({{ asset('home/images/resource/parallax3.jpg') }}) repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible no-parallax"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Tin tức nổi bật</h2>
                        </div><!-- Heading -->
                        <div class="blog-sec">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="my-blog">
                                        <div class="blog-thumb">
                                            <a href="" title=""><img
                                                    src="{{ asset('home/images/resource/b1.jpg') }}"
                                                    alt="" /></a>
                                            <div class="blog-metas">
                                                <a href="" title="">March 29, 2017</a>
                                                <a href="" title="">0 Comments</a>
                                            </div>
                                        </div>
                                        <div class="blog-details">
                                            <h3><a href="" title="">Attract More Attention Sales And
                                                    Profits</a></h3>
                                            <p>A job is a regular activity performed in exchange becoming an
                                                employee, volunteering, </p>
                                            <a href="" title="">Read More <i
                                                    class="la la-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="my-blog">
                                        <div class="blog-thumb">
                                            <a href="" title=""><img
                                                    src="{{ asset('home/images/resource/b2.jpg') }}"
                                                    alt="" /></a>
                                            <div class="blog-metas">
                                                <a href="" title="">March 29, 2017</a>
                                                <a href="" title="">0 Comments</a>
                                            </div>
                                        </div>
                                        <div class="blog-details">
                                            <h3><a href="" title="">11 Tips to Help You Get New
                                                    Clients</a></h3>
                                            <p>A job is a regular activity performed in exchange becoming an
                                                employee, volunteering, </p>
                                            <a href="" title="">Read More <i
                                                    class="la la-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="my-blog">
                                        <div class="blog-thumb">
                                            <a href="" title=""><img
                                                    src="{{ asset('home/images/resource/b3.jpg') }}"
                                                    alt="" /></a>
                                            <div class="blog-metas">
                                                <a href="" title="">March 29, 2017</a>
                                                <a href="" title="">0 Comments</a>
                                            </div>
                                        </div>
                                        <div class="blog-details">
                                            <h3><a href="" title="">An Overworked Newspaper
                                                    Editor</a></h3>
                                            <p>A job is a regular activity performed in exchange becoming an
                                                employee, volunteering, </p>
                                            <a href="" title="">Read More <i
                                                    class="la la-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text">
                            <h3>Liên hệ với chúng tôi</h3>
                            <span>Chúng tôi ở đây để giúp đỡ. Kiểm tra Câu hỏi thường gặp của chúng tôi, gửi email cho chúng
                                tôi hoặc gọi cho chúng tôi theo số 1 (800) 555-5555</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- login --}}
    <div class="account-popup-area signin-popup-box">
        <login-user
            :data="{{ json_encode([
                'urlStore' => route('users.login.store'),
                'urlBack' => route('home'),
            ]) }}">
        </login-user>
    </div><!-- LOGIN POPUP -->
@endsection
