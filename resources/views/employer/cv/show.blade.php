@extends('employer.layout.index')
@section('main-employer')
    <link rel="stylesheet" href="{{ asset('asset/formCv/style.css') }}">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách ứng viên</h5>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <form-show-cv
                        :data="{{ json_encode([
                            'cv' => $cv,
                            'feedback_cv' => $feedback_cv,
                            'accPayment' => $accPayment,
                            'urlPayment' => route('employer.search.paymentCv'),
                            'paymentCv' => $paymentCv,
                            'feedbackAll' => $feedbackAll,
                            'countFeedBackEmployer' => $countFeedBackEmployer,
                        ]) }}">
                    </form-show-cv>
                </div>
            </div>
            <!-- container -->
        </div>
    </div>
@endsection
