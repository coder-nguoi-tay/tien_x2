@extends('seeker.layout.index')
@section('main-seeker')
    <link rel="stylesheet" href="{{ asset('asset/formCv/style.css') }}">
    <create-form-cv
        :data="{{ json_encode([
            'urlStore' => route('users.file.createFormCv'),
        ]) }}">
    </create-form-cv>
@endsection
