@extends('employer.layout.index')
@section('main-employer')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Đăng tin ứng tuyển</h5>
            <edit-new-employer
                :data="{{ json_encode([
                    'lever' => $lever,
                    'experience' => $experience,
                    'wage' => $wage,
                    'skill' => $skill,
                    'job' => $job,
                    'timework' => $timework,
                    'profession' => $profession,
                    'majors' => $majors,
                    'location' => $location,
                    'workingform' => $workingform,
                    'urlStore' => route('employer.new.update', $job->id),
                    'urlBack' => route('employer.new.index'),
                ]) }}">
            </edit-new-employer>
        </div>
    </div>
@endsection
