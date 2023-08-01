@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách ứng viên bị từ chối</h5>
            <a href="{{ route('employer.submittedWork') }}" class="btn btn-primary">Hồ sơ chưa xem</a>
            <a href="{{ route('employer.new.refuse') }}" style="margin-left: 10px" class="btn btn-primary">Hồ sơ đã bị từ
                tối</a>
            <div class="table-responsive mt-4">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="js-check-all"></th>
                            <th>Tên ứng viên</th>
                            <th>lý đo</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filter as $item)
                            <tr>
                                <td><input type="checkbox" value="{{ $item->id }}" name="id[]" class="js-check-one">
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->content }}</td>
                                <td>
                                    <btn-delete :message-confirm="{{ json_encode('Bạn có chắc muốn xóa bài viết?') }}"
                                        :delete-action="{{ json_encode(route('employer.new.deletefilterApply', $item->id)) }}">
                                    </btn-delete>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
