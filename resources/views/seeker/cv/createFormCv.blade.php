@extends('seeker.layout.index')
@section('main-seeker')
    <link rel="stylesheet" href="{{ asset('asset/formCv/style.css') }}">
    <create-form-cv
        :model="{{ json_encode([
            'urlStore' => route('users.file.createFormCv'),
            'skill' => $skill,
            'project' => $project,
            'user' => $user,
            'user_name' => $user_name,
            'level' => $level,
            'app' => $app,
        ]) }}">
    </create-form-cv>
@endsection
