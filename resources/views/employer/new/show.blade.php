@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách ứng viên nộp đơn</h5>
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
                                        <a href="#">Lý do từ chối</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 0)
                                        <a class="btn border" href="">Xem</a>
                                    @endif
                                    @if ($item->status == 1)
                                        <a class="btn border" href="">Xem</a>
                                        |
                                        <a class="btn btn-danger border" href="">Từ chối</a>
                                    @endif
                                    @if ($item->status == 2)
                                        <a class="btn border" href="">Xem</a>
                                    @endif
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
