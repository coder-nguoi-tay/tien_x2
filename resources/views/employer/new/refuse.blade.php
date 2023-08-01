@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách ứng viên bị từ chối</h5>
            <a href="{{ route('employer.submittedWork') }}" class="btn btn-primary">Hồ sơ chưa xem</a>
            <a href="{{ route('employer.new.filterApply') }}" class="btn btn-primary" style="margin-left: 10px">Ứng viên bị cấm nộp
                lại hồ sơ</a>
            <div class="table-responsive mt-4">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="js-check-all"></th>
                            <th>Ảnh</th>
                            <th>Vị trí ứng tuyển</th>
                            <th>ngày nộp đơn</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cv as $item)
                            <tr>
                                <td><input type="checkbox" value="{{ $item->id }}" name="id[]" class="js-check-one">
                                </td>
                                <td><img src="{{ $item->images }}" width="100" alt=""></td>
                                <td>{{ $item->majors_name }}</td>
                                <td>{{ $item->create_at_sv }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="badge p-1 bg-success text-white">Chưa xem</span>
                                    @endif
                                    @if ($item->status == 1)
                                        <span class="badge p-1 bg-warning text-white">Đã xem</span>
                                    @endif
                                    @if ($item->status == 2)
                                        <span class="badge p-1 bg-danger text-white mb-2">Đã từ chối</span>
                                        <br>
                                        <a href="#" onclick="Reason(JSON.parse('{{ $item }}'))">Lý do từ
                                            chối</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 0)
                                        <a class="btn border" target="_blank" href="{{ asset($item->file_cv) }}"
                                            onclick="chanstatusCv(JSON.parse('{{ $item }}'))">Xem</a>
                                    @endif
                                    @if ($item->status == 1)
                                        <a class="btn border" target="_blank" href="{{ asset($item->file_cv) }}">Xem</a>
                                        |
                                        <button class="btn btn-danger border" data-bs-toggle="modal"
                                            data-bs-target="#modalNoteCv">Từ chối</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalNoteCv" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hãy cho chúng tôi
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
                                                                <label for="" class="form-label">Lý do</label>
                                                                <textarea class="form-control" name="content" cols="30" rows="10" placeholder="mời bạn nhập"></textarea>
                                                                <div class="form-group d-flex p-2">
                                                                    <input type="checkbox" name="check_var" id="check_var">
                                                                    <label for="check_var" style="margin-left: 5px">Nếu như
                                                                        bạn không muốn ứng viên
                                                                        nộp hồ sơ vài baif viết của ban!</label>
                                                                </div>
                                                                <button class="btn btn-primary mt-3" type="submit">Phản
                                                                    hồi</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($item->status == 2)
                                        <a class="btn border" href="/{{ $item->file_cv }}" target="_blank">Xem</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
        $(document).ready(function() {
            $('.js-check-all').click(function(e) {
                $('input:checkbox').prop('checked', this.checked);
            });
        })

        function Reason(id) {
            const url = '/employers/new/get-data-reason/' + id.cv_id;
            axios.get(url).then(function(res) {
                $('#dataReasonCv').text(res.data.data.content);
                $('#modalReasonCv').modal('show');
            }).catch(function(error) {
                console.log(error);
            })
        }
    </script>
@endsection
