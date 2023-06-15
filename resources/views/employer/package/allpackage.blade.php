@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tất cả gói cước đang có sẵn</h5>
            <div class="row">
                @foreach ($package as $item)
                    <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">
                            <div class="position-relative">
                                <div class="card-img-top rounded-0" style="height: 100px;">
                                </div>
                                <form action="{{ route('employer.package.payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                    <input type="hidden" name="lever_package" value="{{ $item->lever_package }}">
                                    <button style="border: none"
                                        class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"
                                        name="redirect">Mua</button>
                                </form>
                            </div>
                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">{{ $item->name }}</h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="fw-semibold fs-4 mb-0">{{ $item->price }}</h6>
                                    <ul class="list-unstyled d-flex align-items-center mb-0">
                                        <li><a class="me-1" href="javascript:void(0)">
                                                @if ($item->lever_package == 1)
                                                    7 ngày
                                                @endif
                                                @if ($item->lever_package == 2)
                                                    15 ngày
                                                @endif
                                                @if ($item->lever_package == 3)
                                                    30 ngày
                                                @endif
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
