@extends('seeker.layout.index')
@section('main-seeker')
    <div class="card">
        <div class="card-body row">
            <h5 class="card-title fw-semibold mb-4">CV đã tải lên</h5>
            @foreach ($cv as $item)
                <div class="box-cv col-sm-6">
                    <div class="img">
                        <img src="https://dxwd4tssreb4w.cloudfront.net/image/3c049c5a64e59f365cd7ca1724a326b6" alt="">
                    </div>
                    <div class="box-info">
                        <h4 class="title-cv mt-2"><a href="/{{ $item->file_cv }}" target="_blank">{{ $item->title }}</a>
                        </h4>
                        <ul class="action d-flex">
                            <li><a href="" class="btn btn-sm btn-primary bold tcv-tooltip"><i
                                        class="fa-solid fa-turn-up"></i> Tải xuống</a></li>
                            <li><a href="{{ route('users.file.destroy', $item->id) }}"><i
                                        class="fas fa-trash-alt icon-delete-cv"></i></a></li>
                        </ul>
                    </div>
                </div>
            @endforeach

            @if (count($cv) < 2)
                <a href="{{ route('users.file.create') }}">
                    <div class="plus-box col-sm-6 mt-4 ml-5">
                        <span class="plus-sign" style="font-weight: bold; margin-top: -20px">+</span>
                    </div>
                </a>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body row">
            <h5 class="card-title fw-semibold mb-4">Tạo cv theo mẫu của mặc định</h5>
            <a href="{{ route('users.file.createCv') }}">
                <div class="plus-box col-sm-6 mt-4 ml-5">
                    <span class="plus-sign" style="font-weight: bold; margin-top: -20px">+</span>
                </div>
            </a>
        </div>
    </div>
@endsection
