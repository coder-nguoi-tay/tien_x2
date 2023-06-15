@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Đăng tin ứng tuyển</h5>
            <create-new-employer
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
                    'urlStore' => route('employer.new.store'),
                    'urlBack' => route('employer.new.index'),
                ]) }}">
            </create-new-employer>
        </div>
    </div>
@endsection
