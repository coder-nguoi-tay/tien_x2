@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách tin tuyển dụng trên top</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm
                mới</button>
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
                                        class="badge p-1 {{ $item->status == 1 ? 'bg-success text-white' : 'bg-secondary text-white' }}">{{ $item->status == 0 ? 'Bản nháp' : 'Đang hoạt động' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('employer.new.edit', $item->id) }}">
                                        <i class="fas fa-edit"></i></a>
                                    |
                                    <a href="{{ route('employer.new.destroy', $item->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm tin lên Top tuyển dụng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employer.new.upTopNew') }}" method="post"
                        class="user-chosen-select-container">
                        @csrf
                        <p style="text-align: center ">Số lượng bài bài viết được tải lên top của bạn phụ thuộc vào gói
                            cước mà bạn đã mua <a href="">Xem chi tiết ở đây</a>
                        </p>
                        <select name="job[]" class="form-control">
                            @foreach ($allJob as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-info font-weight-medium color-text-2 mr-1  text-white"
                            style="margin-left: 36%; width: 140px; margin-top: 20px" type="submit">Cập nhật ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('.js-check-all').click(function(e) {
                $j('input:checkbox').prop('checked', this.checked);
            });
            $j('#select2').select2();
        })
    </script>
@endsection
