@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Thông tin doanh nghiệp</h5>
            <div class="plus-box"
                style="width: 200px;
                cursor: pointer;
                height: 200px;
                background-color: #dfdbdb;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 96px;
                color: #fff;">
                <a href="{{ route('employer.company.create') }}" class="plus-sign"
                    style="font-weight: bold; margin-top: -20px">+</a>
            </div>
        </div>
    </div>
@endsection
