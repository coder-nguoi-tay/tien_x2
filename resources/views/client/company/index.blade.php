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
                <span>Tất cả các công ty đang đăng ký trên hệ thống</span>
            </div>
            <div class="cat-sec">
                <div class="row no-gape">
                    @foreach ($company as $item)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="p-category">
                                <a href="{{ route('company.detail', $item->id) }}" title="">
                                    <img class="mt-5" src="{{ asset($item->logo) }}" style="border-radius: 10px"
                                        alt="" width="100">
                                    <span>{{ $item->name }}</span>
                                    <p>({{ count($item->employer->job) }} Việc làm)</p>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
