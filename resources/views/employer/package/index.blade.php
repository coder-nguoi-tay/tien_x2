@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Danh sách gói cước</h5>
            <a href="{{ route('employer.package.create') }}" class="btn btn-primary">Mua gói cước</a>
            <div class="table-responsive mt-4">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Tên gói cước</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Cấp bậc</th>
                            <th scope="col">Thời gian hết hạn</th>
                            <th scope="col">Trạng Thái</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pachageForEmployer as $item)
                            <tr>

                                <td>{{ $item->name_package }}</td>
                                <td>{{ number_format($item->price) }}đ</td>
                                <td>{{ $item->lever_package }}</td>
                                <td>{{ $item->end_time }}</td>
                                <td>
                                    <span
                                        class="badge  p-1 {{ $item->status == 1 ? 'bg-success text-white' : 'bg-secondary text-white' }}">{{ $item->status_package }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('employer.package.edit', $item->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    |
                                    <a href="{{ route('employer.package.destroy', $item->id) }}"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
