<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerCreateRequest;
use App\Models\Accuracy;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Jobskill;
use App\Models\SaveCv;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewEmployerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $checkCompany = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        if ($checkCompany->id_company) {
            $checkCompanyXt = Accuracy::where('user_id', $checkCompany->id_company)->first();
            if ($checkCompanyXt) {
                $checkCompanyStatus = $checkCompanyXt->status;
            }
        }
        $job = Job::query()->where([
            ['job.employer_id', $checkCompany->id],
        ])->with(['AllCv'])
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->select('job.*')
            ->Orderby('job.expired', 'ASC')
            ->get();
        return view(
            'employer.new.index',
            [
                'job' => $job,
                'title' => 'Tin Tuyển Dụng',
                'checkCompany' => $checkCompany,
                'request' => $request,
                'checkCompanyStatus' => $checkCompanyStatus ?? '',
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer.new.create', [
            'lever' => $this->getlever(),
            'experience' => $this->getexperience(),
            'wage' => $this->getwage(),
            'skill' => $this->getskill(),
            'timework' => $this->gettimework(),
            'profession' => $this->getprofession(),
            'majors' => $this->getmajors(),
            'location' => $this->getlocation(),
            'workingform' => $this->getworkingform(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployerCreateRequest $request)
    {
        $end_time = Carbon::parse($request->end_job_time)->format('Y-m-d');
        $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        $slug = $this->convertName($request->title);
        try {
            $job = new Job();
            $job->title = $request->title;
            $job->slug = $slug;
            $job->quatity = $request->quatity;
            $job->sex = $request->sex;
            $job->describe = $request->describe;
            $job->level_id = $request->level_id;
            $job->experience_id = $request->experience_id;
            $job->wage_id = $request->wage_id;
            $job->benefit = $request->benefit;
            $job->profession_id = $request->profession_id;
            $job->location_id = $request->location_id;
            $job->address = $request->address;
            $job->majors_id = $request->majors_id;
            $job->wk_form_id = $request->wk_form_id;
            $job->job_time = Carbon::now();
            $job->end_job_time = $end_time;
            $job->status = $request->status_profile ? 1 : 0;
            $job->time_work_id = $request->time_work_id;
            $job->candidate_requirements = $request->candidate_requirements;
            $job->employer_id = $employer->id;
            $job->save();
            //create to jobskill
            foreach (explode(',', $request->skill[0]) as $item) {
                Jobskill::query()->create([
                    'job_id' => $job->id,
                    'skill_id' => $item
                ])->save();
            }
            $this->setFlash(__('Thêm tin tuyển dụng thành công'));
            return redirect()->route('employer.new.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('employer.new.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cv = SaveCv::query()
            ->join('job', 'job.id', '=', 'save_cv.id_job')
            ->leftjoin('users', 'users.id', '=', 'save_cv.user_id')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->leftjoin('majors', 'majors.id', '=', 'job.majors_id')
            ->where([
                ['job.id', $id],
                // ['save_cv.status', 0],
            ])
            ->select('users.name as user_name', 'users.images as images', 'save_cv.status as status', 'save_cv.id as cv_id', 'save_cv.file_cv as file_cv', 'save_cv.user_id as user_id', 'majors.name as majors_name', 'save_cv.created_at as create_at_sv', 'save_cv.token as token')
            ->get();
        return view('employer.new.show', [
            'cv' => $cv,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employer.new.edit', [
            'title' => 'Sửa tin tuyển dụng',
            'job' => Job::query()->with('getskill')->find($id),
            'lever' => $this->getlever(),
            'experience' => $this->getexperience(),
            'wage' => $this->getwage(),
            'skill' => $this->getskill(),
            'timework' => $this->gettimework(),
            'profession' => $this->getprofession(),
            'majors' => $this->getmajors(),
            'location' => $this->getlocation(),
            'workingform' => $this->getworkingform(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployerCreateRequest $request, $id)
    {
        $end_time = Carbon::parse($request->end_job_time)->format('Y-m-d');
        $slug = $this->convertName($request->title);
        try {
            $job =  Job::query()->find($id);
            $job->title = $request->title;
            $job->slug = $slug;
            $job->quatity = $request->quatity;
            $job->sex = $request->sex;
            $job->describe = $request->describe;
            $job->level_id = $request->level_id;
            $job->experience_id = $request->experience_id;
            $job->wage_id = $request->wage_id;
            $job->benefit = $request->benefit;
            $job->profession_id = $request->profession_id;
            $job->location_id = $request->location_id;
            $job->address = $request->address;
            $job->majors_id = $request->majors_id;
            $job->wk_form_id = $request->wk_form_id;
            $job->end_job_time = $end_time;
            $job->status = $request->status_profile ? 1 : 0;
            $job->time_work_id = $request->time_work_id;
            $job->candidate_requirements = $request->candidate_requirements;
            $job->save();
            //create to jobskill
            $jobskill =  Jobskill::query()->where('job_id', $id)->get()->pluck('id');
            Jobskill::query()->whereIn('id', $jobskill)->delete();
            foreach (explode(',', $request->skill[0]) as $item) {
                Jobskill::query()->create([
                    'job_id' => $job->id,
                    'skill_id' => $item
                ])->save();
            }
            $this->setFlash(__('Cập nhật tin tuyển dụng thành công'));
            return redirect()->route('employer.new.index');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('employer.new.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Jobskill::query()->where('job_id', $id)->delete();
            Job::query()->find($id)->delete();
            $this->setFlash(__('Xóa thành công'));
            return redirect()->route('employer.new.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->setFlash(__('Đã có một lỗi sảy ra'), 'error');
            return redirect()->route('employer.new.index');
        }
    }
}
