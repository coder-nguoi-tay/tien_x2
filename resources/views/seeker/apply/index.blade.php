@extends('seeker.layout.index')
@section('main-seeker')
    <div class="card">
        <div class="card-body row">
            <h5 class="card-title fw-semibold mb-4">Công việc mà bạn đã ứng tuyển</h5>
            <div class="card w-100">
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"></h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên công việc</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày nộp đơn</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"></h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apply as $item)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><img src="{{ asset($item->logo) }}"
                                                    style="border-radius: 10px" alt="" width="100"></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('client.detail', [$item->slug, $item->id]) }}">
                                                <h6 class="fw-semibold mb-1">{{ $item->title }}</h6>
                                            </a>
                                            <span class="fw-normal"><a
                                                    href="{{ route('company.detail', $item->idCompany) }}">{{ $item->nameCompany }}</a></span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="align-items-center gap-2">
                                                @if ($item->status == 0)
                                                    <span class="badge bg-danger rounded-3 fw-semibold"
                                                        style="font-size: 12px">chưa xem</span>
                                                @endif
                                                @if ($item->status == 1)
                                                    <span class="badge bg-primary rounded-3 fw-semibold"
                                                        style="font-size: 12px">đã xem</span>
                                                @endif
                                                @if ($item->status == 2)
                                                    <span class="badge bg-dark rounded-3 fw-semibold mb-2"
                                                        style="font-size: 12px;">bị hủy</span>
                                                    <br>
                                                    <a href="#" onclick="Reason(JSON.parse('{{ $item }}'))">Lý
                                                        do từ chối</a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">{{ $item->created_at }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ asset($item->file) }}">Xem Cv</a>
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
    {{-- modal ly do --}}
    <div class="modal fade" id="modalReasonCv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lý do
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="title">
                        <span id="dataReasonCv"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function Reason(id) {
            const url = '/users/get-data-reason/' + id.id_save_cv;
            await axios.get(url).then(function(res) {
                $('#dataReasonCv').text(res.data.data.content);
            })
            $('#modalReasonCv').modal('show');
        }
    </script>
@endsection
