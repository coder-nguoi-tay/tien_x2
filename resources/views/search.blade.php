@extends('layouts.index')
@section('home')
    <form-search-home
        :data="{{ json_encode([
            'lever' => $lever,
            'experience' => $experience,
            'wage' => $wage,
            'skill' => $skill,
            'timework' => $timework,
            'profession' => $profession,
            'majors' => $majors,
            'location' => $location,
            'workingform' => $workingform,
            'request' => $request,
            'job' => $job,
        ]) }}">
    </form-search-home>
@endsection
