@extends('layouts.index')
@section('home')
    <section id="intro">
        <div class="carousel-item active">
            <div class="carousel-background"><img src="{{ asset('asset/imags/slider/slider1.jpg') }}" alt="">
            </div>
            <div class="carousel-container">
                <div class="carousel-content">
                    <h2 class="font-color-white">Find Jobs Now more Easy Way</h2>
                    <p class="font-color-white">Lorem ipsum tempus amet conubia adipiscing fermentum viverra gravida,
                        mollis suspendisse pretium dictumst inceptos mattis euismod lorem nulla, magna duis nostra
                        sodales luctus nulla praesent fermentum a elit mollis purus aenean curabitur eleifend </p>
                    <div class="Post-Jobs">
                        <a href="{{ route('users.login.index') }}" class="">
                            Muốn tìm việc
                        </a>
                    </div>
                    <div class="Post-Jobs search-seeker">
                        <a href="" class="">
                            Muốn tìm người
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- search --}}
    <div id="search-box">
        <div class="container search-box">
            <form action="{{ route('home.search') }}" id="search-box_search_form_3"
                class="search-box_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between ">
                <div class="d-flex flex-row align-items-center justify-content-start inline-block">
                    <span class="large material-icons search">search</span>
                    <input class="search-box_search_input" name="key" placeholder="Search Keyword"
                        type="search">
                    <select name="majors" class="dropdown_item_select search-box_search_input">
                        <option value="">Chọn ngành nghề</option>
                        @foreach ($majors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="large material-icons search">place</span>
                    <select name="location" class="dropdown_item_select search-box_search_input">
                        <option value="">Chọn địa chỉ</option>
                        @foreach ($location as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="search-box_search_button">Tìm kiếm</button>
            </form>
        </div>
    </div>

    {{-- ngành nghề --}}

    <section id="Job-Category">
        <div class="container">
            <h3 class="text-center">Thống kê các ngành nghề đang có</h3>
            <div class="vertical-space-30"></div>
            <p class="max-width">Lorem ipsum tempus amet conubia adipiscing fermentum viverra gravida, mollis
                suspendisse pretium dictumst inceptos mattis euismod
            </p>
            <div class="vertical-space-60"> </div>
            <div class="row">
                @foreach ($majors as $item)
                    <div class="col-lg-3 col-md-6 max-width-50">
                        <div class="box background-color-white-light">
                            <div class="circle">
                                <img src="{{ $item->image_majors }}" alt="">
                            </div>
                            <h6>{{ $item->name }}</h6>
                            <a href="#" class="button job_post" style="font-size: 16px" data-hover="View Jobs"
                                data-active="I'M ACTIVE"><span>{{ count($item->majors) }}
                                    Việc làm</span></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="vertical-space-40"></div>
            <a href="#" class="Brows-All-Category">Xem tất cả</a>
        </div>
        <div class="vertical-space-85"></div>
    </section>

    {{-- job --}}

    <section id="resent-job-post" class="background-color-white">
        <div class="vertical-space-85"></div>
        <div class="container text-center">
            <h3 class="text-center">Việc làm dành cho bạn</h3>
            <div class="vertical-space-30"></div>
            <div class="vertical-space-60"></div>
            <div id="paginated-list">
                @foreach ($job as $item)
                    <div class="detail render-job-search">
                        <div class="media display-inline text-align-center">
                            <img src="{{ $item->logo }}" width="100" style="border-radius: 5px" alt="John Doe"
                                class="mr-3 ">
                            <div class="media-body text-left text-align-center">
                                <h6><a
                                        href="{{ route('client.detail', [$item->slug, $item->id]) }}">{{ $item->title }}</a>
                                </h6>
                                <i class="large material-icons">account_balance</i>
                                <span class="text">{{ $item->nameCompany }}</span>
                                <br />
                                <i class="large material-icons">place</i>
                                <span class="text font-size">{{ $item->addressCompany }}</span>
                                <div class="float-right margin-top text-align-center">
                                    <a href="#" class="part-full-time">{{ $item->getTime_work->name }}</a>
                                    <p class="date-time">Hạn: {{ $item->end_job_time }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="vertical-space-20"></div>
            {{-- paginate --}}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 job-list">
                    <span class="text-center p-3">
                        <div id="pagination-numbers" style="margin-bottom: 20px">
                        </div>
                    </span>
                </div>
            </div>
            {{-- end paginate --}}
        </div>
        <div class="vertical-space-60"></div>
    </section>
    {{-- end job --}}

    <section id="Featuread-Company">
        <div class="vertical-space-85"></div>
        <div class="container text-center">
            <h3 class="text-center">Những công ty tiêu biểu</h3>
            <div class="vertical-space-30"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="owl-carousel Featuread-Company-carousel">
                        @foreach ($company as $item)
                            <a href="#" class="Featuread-Company-item">
                                <div class="media text-align-center  media1">
                                    <img src="{{ $item->logo }}" width="100" alt="John Doe"
                                        class=" Featuread-Company-img margin-auto">
                                    <div class="media-body text-left text-align-center ">
                                        <h6>{{ $item->name }}</h6>
                                        <br />
                                        <i class=" material-icons">place</i>
                                        <span class="text font-size">{{ $item->address }}</span>
                                        <br />
                                        <i class=" material-icons">person</i>
                                        <span class="text font-size font-color-orange">{{ count($item->employer->job) }}
                                            Bài đăng</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="vertical-space-85"></div>
        </div>
    </section>


    <section id="Jobtend">
        <div class="container">
            <div class="vertical-space-85"></div>
            <div class="row">
                <div class="col-lg-9 col-md-6  align-self-center">
                    <h3 class="title">Jobtend - Best Place to Find Jobs & Employee</h3>
                    <div class="vertical-space-30"></div>
                    <p class="max-width">Lorem ipsum tempus amet conubia adipiscing fermentum viverra gravida, mollis
                        suspendisse pretium dictumst inceptos mattis euismod lorem nulla magna duis nostra sodales
                        luctus nulla
                    </p>
                    <div class="vertical-space-30"></div>
                    <h4>Why we are best</h4>
                    <div class="vertical-space-30"></div>
                    <ul>
                        <li class="list-item1 ">Et vestibulum ullamcorper curae tellus consectetur erat pharetra et
                            cubilia
                            <br /> Nibh est auctor lacus nam lacinia aptent
                        </li>
                        <li class="list-item1 ">Vitae sociosqu a nisi cubilia vulputate aliquam vulputate imperdiet
                            tempor arcu fames</li>
                        <li class="list-item1 ">Odio habitasse senectus morbi dapibus mauris non primis, nisl ante
                            hendrerit consectetur nulla phasellus eleifend, ad at scelerisque vulputate habitant tempor
                        </li>
                    </ul>
                    <div class="vertical-space-30"></div>
                    <a href="#" class="Explore-Employee">Explore Employee</a>
                    <a href="#" class="Explore-New-Jobs">Explore New Jobs</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <img src="{{ asset('asset/imags/man.png') }}" alt="" class="man-img">
                </div>
                <div class="vertical-space-60"></div>
            </div>
        </div>
    </section>
@endsection
