@extends('employer.layout.index')
@section('main-employer')
    <div class="container">
        <change-password
            :data="{{ json_encode([
                'urlStore' => route('employer.changePasswordSucsses'),
            ]) }}">
        </change-password>
    </div>
@endsection
