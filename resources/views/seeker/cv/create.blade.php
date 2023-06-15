@extends('seeker.layout.index')
@section('main-seeker')
    <div class="card">
        <div class="card-body">
            <create-cv
                :data="{{ json_encode([
                    'urlStore' => route('users.file.store'),
                    'urlBack' => route('users.file.create'),
                ]) }}">
            </create-cv>
        </div>
    </div>
@endsection
