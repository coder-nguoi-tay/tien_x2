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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="scroll-here">
        <main class="main  p-2">
            <section class="section-box-2">
                <div class="container">
                    <div class="box-company-profile">

                        <div class="image-compay">
                            <img src="{{ asset($company->logo) }}" style="height: 85px; width: 85px;" alt="Logo">
                        </div>
                    </div>
                    <div class="border-bottom pt-10 pb-10"></div>
                </div>
            </section>

            <section class="section-box mt-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <div class="content-single">


                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-about-us" role="tabpanel"
                                        aria-labelledby="tab-about-us">
                                        <h4>Chào mừng đến với {{ $company->name }}</h4>
                                        {!! $company->desceibe !!}

                                    </div>
                                </div>
                                <h4>công việc đang tuyển</h4>
                                <div class="job-listings-sec" id="paginated-list">
                                    @foreach ($company->employer->job as $item)
                                        <div class="job-listing render-job-search border">
                                            <div class="job-title-sec">
                                                <h3><a href="{{ route('client.detail', [$item->slug, $item->id]) }}"
                                                        title="">{{ $item->title }}</a></h3>
                                                <span><a
                                                        href="{{ route('company.detail', $item->id) }}">{{ $item->nameCompany }}</a></span>
                                            </div>
                                            <span class="fav-job">còn {{ $item->convert_date }} ngày</span>
                                            <span class="job-is ft">{{ $item->getTime_work->name }}</span>
                                        </div><!-- Job -->
                                    @endforeach
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">

                            <div class="sidebar-border">
                                <div class="sidebar-list-job">
                                    <div class="box-map">
                                        <iframe
                                            src="https://maps.google.com/maps?q=40.712776,-74.005974&amp;hl=es&amp;z=14&amp;output=embed"
                                            allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <!--google map-->
                                </div>


                                <div class="sidebar-list-job">
                                    <ul class="ul-disc">
                                        <li>{{ $company->address }}</li>
                                        <li>Quy mô: {{ $company->number_tax }}</li>
                                        <li>Email: {{ $company->email }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </section>
@endsection
