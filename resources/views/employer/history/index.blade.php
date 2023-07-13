@php
    use Carbon\Carbon;
@endphp
@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Lịch sử giao dịch</h5>
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        @foreach ($paymentHistory as $item)
                            <ul class="timeline-widget mb-0 position-relative">
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div class="timeline-time text-dark flex-shrink-0 text-end">
                                        {{ Carbon::parse($item->created_at)->format('d-m-yy') }}</div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center"
                                    >
                                        <span
                                            class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark">{{ $item->desceibe }}
                                        <br>
                                        {{ number_format($item->price) }}đ
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
