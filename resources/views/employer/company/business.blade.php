@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Giấy phép kinh doanh</h5>
            <business-license
                :data="{{ json_encode([
                    'email' => Auth::guard('user')->user()->email,
                    'urlAccuracyCompany' => route('employer.company.ImageAccuracy'),
                    'accuracy' => $accuracy,
                ]) }}">
            </business-license>
        </div>
    </div>
@endsection
