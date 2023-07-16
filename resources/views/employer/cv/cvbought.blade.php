@extends('employer.layout.index')
@section('main-employer')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .card-box {
            padding: 20px;
            border-radius: 3px;
            margin-bottom: 30px;
            background-color: #fff;
        }

        .social-links li a {
            border-radius: 50%;
            color: rgba(121, 121, 121, .8);
            display: inline-block;
            height: 30px;
            line-height: 27px;
            border: 2px solid rgba(121, 121, 121, .5);
            text-align: center;
            width: 30px
        }

        .social-links li a:hover {
            color: #797979;
            border: 2px solid #797979
        }

        .thumb-lg {
            height: 55px;
            width: 55px;
        }

        .img-thumbnail {
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            max-width: 100%;
            height: auto;
        }

        .text-pink {
            color: #ff679b !important;
        }

        .btn-rounded {
            border-radius: 2em;
        }

        .text-muted {
            color: #98a6ad !important;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách hồ sơ đã mua</h5>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    @foreach ($cv as $item)
                        <div class="col-lg-4">
                            <div class="text-center card-box">
                                <div class="member-card pt-2 pb-2">
                                    <div class="thumb-lg member-thumb mx-auto">
                                        <img src="{{ asset($item->profileCv->images) }}"
                                            class="rounded-circle img-thumbnail" alt="profile-image" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="">
                                        <h4>{{ $item->profileCv->name }}</h4>
                                        <p class="text-muted"> </span><span><a
                                                    href="{{ route('employer.search.show', $item->id) }}"
                                                    class="text-pink">{{ $item->profileCv->majors }}</a></span></p>
                                    </div>
                                    <a href="{{ route('employer.search.show', $item->id) }}"
                                        class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">Xem chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- end col -->
                </div>
            </div>
            <!-- container -->
        </div>
    </div>
@endsection
