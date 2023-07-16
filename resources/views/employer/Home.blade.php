@php
    use Carbon\Carbon;
    
    $totalCv = $countCvMoth1 + $countCvMoth2 + $countCvMoth3 + $countCvMoth4 + $countCvMoth5 + $countCvMoth6 + $countCvMoth7 + $countCvMoth8 + $countCvMoth9 + $countCvMoth10 + $countCvMoth11 + $countCvMoth12;
@endphp
@extends('employer.layout.index')
@section('main-employer')
    <div class="row">
        <div class="col-lg-3">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden" style="background: #dff7e4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold" style="color: #264b06">Tổng số bài viết đã đăng</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 fs-8">{{ $job }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden" style="background: rgb(241 229 212)">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold" style="color: rgb(231 105 105)">Tổng số hồ sơ đã mua</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 fs-8">{{ $tatalecv }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <!-- Monthly Earnings -->
            <div class="card" style="background: rgb(235 237 241);">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold" style="color: #0e4e7d">Tài khoản</h5>
                            <h4 class="fw-semibold mb-3">{{ number_format($totalPayment) }}đ</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-currency-dollar fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden" style="background: rgb(233 233 233)">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold" style="color: #585b5d">Tổng số hồ sơ đã nhận</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 fs-8">{{ $cv }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="height: 500px">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Tổng số lượng ứng viên đã ứng tuyển: {{ $totalCv }} hồ
                                sơ</h5>
                        </div>
                        <div>
                            <date-year-employer :data="{{ json_encode($request) }}">
                            </date-year-employer>
                        </div>
                    </div>
                    {{-- biểu đồ --}}
                    <char-employer
                        :chart="{{ json_encode([
                            'countCvMoth1' => $countCvMoth1,
                            'countCvMoth2' => $countCvMoth2,
                            'countCvMoth3' => $countCvMoth3,
                            'countCvMoth4' => $countCvMoth4,
                            'countCvMoth5' => $countCvMoth5,
                            'countCvMoth6' => $countCvMoth6,
                            'countCvMoth7' => $countCvMoth7,
                            'countCvMoth8' => $countCvMoth8,
                            'countCvMoth9' => $countCvMoth9,
                            'countCvMoth10' => $countCvMoth10,
                            'countCvMoth11' => $countCvMoth11,
                            'countCvMoth12' => $countCvMoth12,
                        ]) }}">
                    </char-employer>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Lịch sử giao dịch</h5>
                    </div>
                    @foreach ($paymentHistory as $item)
                        <ul class="timeline-widget mb-0 position-relative">
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time text-dark flex-shrink-0 text-end">
                                    {{ Carbon::parse($item->created_at)->format('d-m-yy') }}</div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
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
                <a href="{{ route('employer.payment-history.index') }}" class="text-center pb-2 fs-3">xem tất cả</a>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Hồ sơ mới nhận gần đây</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">#</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thông tin</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Vị trí</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Acction</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cvApplyNew as $item)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $item->token }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $item->user_name }}</h6>
                                            <span class="fw-normal">{{ $item->majors_name }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $item->time_work_name }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                @if ($item->status == 0)
                                                    <span class="badge p-1 bg-success text-white">Chưa xem</span>
                                                @endif
                                                @if ($item->status == 1)
                                                    <span class="badge p-1 bg-warning text-white">Đã xem</span>
                                                @endif
                                                @if ($item->status == 2)
                                                    <span class="badge p-1 bg-danger text-white mb-2">Đã từ chối</span>
                                                    <br>
                                                    <a href="javascript:void(0)"
                                                        onclick="Reason(JSON.parse('{{ $item }}'))">Lý do từ
                                                        chối</a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <a class="btn border" href="/{{ $item->file_cv }}"
                                                    onclick="chanstatusCv(JSON.parse('{{ $item }}'))">Xem</a>
                                            @endif
                                            @if ($item->status == 1)
                                                <a class="btn border" href="/{{ $item->file_cv }}">Xem</a>
                                                |
                                                <button class="btn btn-danger border" data-bs-toggle="modal"
                                                    data-bs-target="#modalNoteCv">Từ chối</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalNoteCv" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hãy cho
                                                                    chúng tôi
                                                                    biết lý do mà bạn loại bỏ CV này là gì?
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="title">
                                                                    <form action="{{ route('employer.new.reasonCv') }}"
                                                                        method="POST" class="form">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $item->cv_id }}"
                                                                            name="cv_id">
                                                                        <input type="hidden" value="{{ $item->cv_id }}"
                                                                            name="job_id">
                                                                        <label for="" class="form-label">Lý
                                                                            do</label>
                                                                        <textarea class="form-control" name="content" cols="30" rows="10" placeholder="mời bạn nhập"></textarea>
                                                                        <button class="btn btn-primary mt-3"
                                                                            type="submit">Phản
                                                                            hồi</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->status == 2)
                                                <a class="btn" href="/{{ $item->file_cv }}">Xem</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
