@extends('seeker.layout.index')
@section('main-seeker')
    <div class="container">
        <change-password
            :data="{{ json_encode([
                'urlStore' => route('users.changePasswordSucsses'),
            ]) }}">
        </change-password>
    </div>
@endsection
