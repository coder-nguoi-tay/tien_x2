@extends('employer.layout.index')
@section('main-employer')
    <style>
        .icon-check-very {
            color: rgb(20, 148, 252)
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách tin tuyển dụng</h5>
            <a href="{{ route('employer.new.create') }}" class="btn btn-primary">Thêm mới</a>
            <a href="{{ route('employer.new.topNew') }}" class="btn btn-primary" style="margin-left: 10px">Đẩy tim lên Top hiển
                thị</a>
            <div class="table-responsive mt-4">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="js-check-all"></th>
                            <th>Tiêu đề</th>
                            <th>Ứng tuyển</th>
                            <th>Ngày đăng</th>
                            <th>Ngày hết hạn</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job as $item)
                            <tr>
                                <td><input type="checkbox" value="{{ $item->id }}" name="id[]" class="js-check-one">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td><a href="{{ route('employer.new.show', $item->id) }}">{{ count($item->AllCv) }}</a></td>
                                <td>{{ $item->job_time }}</td>
                                <td>{{ $item->end_job_time }}</td>
                                <td><span
                                        class="badge p-1 {{ $item->expired == 0 ? 'bg-success text-white' : 'bg-dark text-white' }}">{{ $item->expired == 1 ? 'Hết hạn' : 'Đang hoạt động' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('employer.new.edit', $item->id) }}"><i class="fas fa-edit"></i></a>
                                    |
                                    <btn-delete :message-confirm="{{ json_encode('Bạn có chắc muốn xóa bài viết?') }}"
                                        :delete-action="{{ json_encode(route('employer.new.destroy', $item->id)) }}">
                                    </btn-delete>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác thực tài khoản doanh nghiệp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <span class="fs-5">
                        - Để sử dụng dịch vụ của chúng tôi, bạn và doanh nghiệp cần xác thực doanh nghiệp bằng 2 bước sau
                        đây: <br>
                        Bước 1: Thêm thông tin công ty <a href="{{ route('employer.company.index') }}">tại đây</a>
                        @if ($company)
                            <span
                                style="margin-right: 410px;
                                margin-top: 3px;
                                float: right;
                                display: flex;
                                justify-content: space-evenly;
                                align-items: center;
                                border: 1px solid rgb(20, 148, 252);
                                border-radius: 50%;
                                width: 20px;
                                height: 20px;">
                                <i class="fas fa-check" style="color: rgb(20, 148, 252); font-size: 10px"></i>
                            </span>
                        @endif

                        <br>
                        Bước 2: Xác thực giấy phép kinh doanh <a href="{{ route('employer.company.business') }}">tại
                            đây</a>
                        @if ($accuracy)
                            <span
                                style="margin-right: 350px;
                                margin-top: 5px;
                                float: right;
                                display: flex;
                                justify-content: space-evenly;
                                align-items: center;
                                border: 1px solid rgb(20, 148, 252);
                                border-radius: 50%;
                                width: 20px;
                                height: 20px;">
                                <i class="fas fa-check" style="color: rgb(20, 148, 252); font-size: 10px"></i>
                            </span>
                        @endif
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-check-all').click(function(e) {
                $('input:checkbox').prop('checked', this.checked);
            });
            console.log();
            if ({!! json_encode($company) !!} && {!! json_encode($acctiveAccuracy) !!}) {
                $('#exampleModal').modal('hidden');
            } else {
                $('#exampleModal').modal('show');
            }

        })
    </script>
@endsection
