@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Thông tin doanh nghiệp</h5>
            <create-company
                :data="{{ json_encode([
                    'urlStore' => route('employer.company.store'),
                ]) }}">
            </create-company>
        </div>
    </div>
@endsection
