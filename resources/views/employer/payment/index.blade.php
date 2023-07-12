@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Nạp tiền vào tài khoản</h5>
            <form action="{{ route('employer.payment-for-emplyer.store') }}" method="POST" class="p-5">
                @csrf
                <div class="form-group">
                    <label for="">Số tiền bạn muốn nạp</label>
                    <input type="text" name="pay_member" class="form-control mt-2">
                </div>
                <div class="form-group mt-2">
                    <label for="">Mô tả</label>
                    <input type="text" name="desceibe" class="form-control mt-2">
                </div>
                <button class="btn btn-primary mt-3" type="submit" name="redirect">
                    Thực hiện
                </button>
            </form>
        </div>
    </div>
@endsection
