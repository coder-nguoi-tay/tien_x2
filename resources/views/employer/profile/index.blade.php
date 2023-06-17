@extends('employer.layout.index')
@section('main-employer')
    <style>
        .card {
            width: 350px;
            background-color: #efefef;
            border: none;
            cursor: pointer;
            transition: all 0.5s;
        }

        .image img {
            transition: all 0.5s
        }

        .card:hover .image img {
            transform: scale(1.5)
        }

        .btn {
            height: 140px;
            width: 140px;
            border-radius: 50%
        }

        .name {
            font-size: 22px;
            font-weight: bold
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }

        .number {
            font-size: 22px;
            font-weight: bold
        }

        .follow {
            font-size: 12px;
            font-weight: 500;
            color: #444444
        }

        .btn1 {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #000;
            color: #aeaeae;
            font-size: 15px
        }

        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500
        }

        .icons i {
            font-size: 19px
        }

        hr .new1 {
            border: 1px solid
        }

        .join {
            font-size: 14px;
            color: #a0a0a0;
            font-weight: bold
        }

        .date {
            background-color: #ccc
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Thông tin cá nhân</h5>
            <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
                <div class="card p-4">
                    <div class=" image d-flex flex-column justify-content-center align-items-center"> <button
                            class="btn btn-secondary"> <img src="{{ Auth::guard('user')->user()->images }}" height="100"
                                width="100" /></button> <span
                            class="name mt-3">{{ Auth::guard('user')->user()->name }}</span> <span class="idd">@
                            {{ Auth::guard('user')->user()->slug }}</span>
                        <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span
                                class="number">{{ $countJob }} <span class="follow">Bài
                                    đăng</span></span> </div>
                        <div class=" d-flex mt-2"> <a href=""><i class="fas fa-edit"></i></a> </div>
                        <div class="text mt-3 text-center">
                            <span>Cảm ơn bạn đã tin tưởng và sử dụng ứng dụng của chúng tôi<br><br>
                                Chúng tôi luôn luôn năng cấp hệ thống thường xuyên để giúp người dùng có trải nghiệm tốt
                                nhất</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
