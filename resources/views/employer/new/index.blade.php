@extends('employer.layout.index')
@section('main-employer')
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
                                        class="badge p-1 {{ $item->status == 1 ? 'bg-success text-white' : 'bg-secondary text-white' }}">{{ $item->status == 0 ? 'Bản nháp' : 'Đang hoạt động' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('employer.new.edit', $item->id) }}"><i class="fas fa-edit"></i></a>
                                    |
                                    <btn-delete
                                        :message-confirm="{{ json_encode('Bạn có chắc muốn xóa bài viết?') }}"
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
    <script>
        $(document).ready(function() {
            $('.js-check-all').click(function(e) {
                $('input:checkbox').prop('checked', this.checked);
            });
        })
    </script>
@endsection
