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
                                        <span>{{ $item->nameCompany }}</span>
                                    </div>
                                    <span class="job-lctn"><i class="la la-map-marker"></i>{{ $item->address }}</span>
                                    <span class="fav-job"><i class="fa fa-heart"></i></span>
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
                                            <a href="" title="">
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
    @if (Auth::guard('user')->check())
        <section id="scroll-here">
            <div class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading">
                                <h2>Việc làm dành cho bạn</h2>
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
                                            <span>{{ $item->nameCompany }}</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>{{ $item->address }}</span>
                                        <span class="fav-job"><i class="fa fa-heart"></i></span>
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
    @endif
    <section>
        <div class="block">
            <div data-velocity="-.1"
                style="background: url({{ asset('home/images/resource/parallax2.jpg') }}) repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible layer color light"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading light">
                            <h2>Kind Words From Happy Candidates</h2>
                            <span>What other people thought about the service provided by JobHunt</span>
                        </div><!-- Heading -->
                        <div class="reviews-sec" id="reviews-carousel">
                            <div class="col-lg-6">
                                <div class="reviews">
                                    <img src="{{ asset('home/images/resource/r1.jpg') }}" alt="" />
                                    <h3>Augusta Silva <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out
                                        quickly with everything! Can’t quite believe the service</p>
                                </div><!-- Reviews -->
                            </div>
                            <div class="col-lg-6">
                                <div class="reviews">
                                    <img src="{{ asset('home/images/resource/r2.jpg') }}" alt="" />
                                    <h3>Ali Tufan <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out
                                        quickly with everything! Can’t quite believe the service</p>
                                </div><!-- Reviews -->
                            </div>
                            <div class="col-lg-6">
                                <div class="reviews">
                                    <img src="{{ asset('home/images/resource/r1.jpg') }}" alt="" />
                                    <h3>Augusta Silva <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out
                                        quickly with everything! Can’t quite believe the service</p>
                                </div><!-- Reviews -->
                            </div>
                            <div class="col-lg-6">
                                <div class="reviews">
                                    <img src="{{ asset('home/images/resource/r2.jpg') }}" alt="" />
                                    <h3>Ali Tufan <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out
                                        quickly with everything! Can’t quite believe the service</p>
                                </div><!-- Reviews -->
                            </div>
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
                            <h2>Các công ty đang hợp tác</h2>
                            <span>Một số công ty chúng tôi đã giúp tuyển dụng những ứng viên xuất sắc trong những năm
                                qua.</span>
                        </div><!-- Heading -->
                        <div class="comp-sec">
                            <div class="company-img">
                                <a href="" title=""><img src="{{ asset('home/images/resource/cc1.jpg') }}"
                                        alt="" /></a>
                            </div><!-- Client  -->
                            <div class="company-img">
                                <a href="" title=""><img src="{{ asset('home/images/resource/cc2.jpg') }}"
                                        alt="" /></a>
                            </div><!-- Client  -->
                            <div class="company-img">
                                <a href="" title=""><img src="{{ asset('home/images/resource/cc3.jpg') }}"
                                        alt="" /></a>
                            </div><!-- Client  -->
                            <div class="company-img">
                                <a href="" title=""><img src="{{ asset('home/images/resource/cc4.jpg') }}"
                                        alt="" /></a>
                            </div><!-- Client  -->
                            <div class="company-img">
                                <a href="" title=""><img src="{{ asset('home/images/resource/cc5.jpg') }}"
                                        alt="" /></a>
                            </div><!-- Client  -->
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
                class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Tin tức nổi bật</h2>
                            <span>Found by employers communicate directly with hiring managers and
                                recruiters.</span>
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

    <div class="account-popup-area signup-popup-box">
        <div class="account-popup">
            <span class="close-popup"><i class="la la-close"></i></span>
            <h3>Sign Up</h3>
            <div class="select-user">
                <span>Candidate</span>
                <span>Employer</span>
            </div>
            <form>
                <div class="cfield">
                    <input type="text" placeholder="Username" />
                    <i class="la la-user"></i>
                </div>
                <div class="cfield">
                    <input type="password" placeholder="********" />
                    <i class="la la-key"></i>
                </div>
                <div class="cfield">
                    <input type="text" placeholder="Email" />
                    <i class="la la-envelope-o"></i>
                </div>
                <div class="dropdown-field">
                    <select data-placeholder="Please Select Specialism" class="chosen">
                        <option>Web Development</option>
                        <option>Web Designing</option>
                        <option>Art & Culture</option>
                        <option>Reading & Writing</option>
                    </select>
                </div>
                <div class="cfield">
                    <input type="text" placeholder="Phone Number" />
                    <i class="la la-phone"></i>
                </div>
                <button type="submit">Signup</button>
            </form>
            <div class="extra-login">
                <span>Or</span>
                <div class="login-social">
                    <a class="fb-login" href="" title=""><i class="fa fa-facebook"></i></a>
                    <a class="tw-login" href="" title=""><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div><!-- SIGNUP POPUP -->
@endsection
