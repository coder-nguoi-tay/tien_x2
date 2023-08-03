<?php

namespace App\Http\Controllers;

use App\Enums\StatusCode;
use App\Events\User\MailApplyJobEvent;
use App\Models\Company;
use App\Models\Favourite;
use App\Models\FilterApplyJob;
use App\Models\Job;
use App\Models\Jobseeker;
use App\Models\Jobskill;
use App\Models\KeyUserSearch;
use App\Models\location;
use App\Models\Majors;
use App\Models\News;
use App\Models\SaveCv;
use App\Models\SeekerSkill;
use App\Models\UploadCv;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('user')->check()) {
            if (Auth::guard('user')->user()->role_id == 2) {
                return redirect(route('employer.index'));
            }
        }
        $majors = Majors::query()->get();

        $location = location::query()->get();
        // news 
        $news = News::query()->with('majors')->limit(3)->get();

        $allJob = Job::query()->get();
        // Việc làm nổi bật
        $arrayForUser = [
            'experience_id' => '',
            'wage_id' => '',
            'location_id' => '',
            'majors_id' => '',
        ];

        $jobSeekerForUser =  Auth::guard('user')->check() && Auth::guard('user')->user()->role_id == 1
            && User::query()->find(Auth::guard('user')->user()->id)->getCheckUser
            ? Jobseeker::query()->where('user_id', Auth::guard('user')->user()->id)->first()->toArray()
            : $arrayForUser;
        // 
        $skillForUserLogin = [];
        if (count($jobSeekerForUser) > 4) {
            $skillForUserLogin =  SeekerSkill::query()->where('job-seeker_id', $jobSeekerForUser['id'])->get()->pluck('skill_id')->toArray();
        }
        $jobForUser = Job::query()
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->join('job_skill', 'job_skill.job_id', '=', 'job.id')
            ->join('skill', 'job_skill.skill_id', '=', 'skill.id')
            ->where([
                ['job.status', 1],
                ['job.expired', 0],
                ['job.package_id_position', 1],
                ['employer.position', 1],
            ])
            ->orWhere([
                ['job.experience_id', $jobSeekerForUser['experience_id']],
                ['job.wage_id', $jobSeekerForUser['wage_id']],
                ['job.location_id', $jobSeekerForUser['location_id']],
                ['job.majors_id', $jobSeekerForUser['majors_id']],
            ])
            ->whereIn('job_skill.skill_id', $skillForUserLogin)
            ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany', 'company.address as addressCompany')
            ->orderBy('employer.prioritize', 'desc')
            ->distinct()
            ->get();

        // việc làm hấp dẫn
        $jobAttractive = Job::query()
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->join('job_skill', 'job_skill.job_id', '=', 'job.id')
            ->join('skill', 'job_skill.skill_id', '=', 'skill.id')
            ->where([
                ['job.status', 1],
                ['job.expired', 0],
                ['job.package_id_position', 0],
            ])
            ->orwhere([
                ['employer.position', 1],
                ['job.package_id_position', 0]
            ])
            ->orwhere([
                ['employer.position', 0]
            ])
            ->orWhere([
                ['job.experience_id', $jobSeekerForUser['experience_id']],
                ['job.wage_id', $jobSeekerForUser['wage_id']],
                ['job.location_id', $jobSeekerForUser['location_id']],
                ['job.majors_id', $jobSeekerForUser['majors_id']],
            ])
            ->whereIn('job_skill.skill_id', $skillForUserLogin)
            ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany', 'company.address as addressCompany')
            ->orderBy('employer.prioritize', 'desc')
            ->distinct()
            ->get();

        // company
        $company = Company::query()->with('employer.job')->get();
        return view('index', [
            'majors' => $majors,
            'job' => $jobForUser,
            'location' => $location,
            'company' => $company,
            'countJob' => $allJob->count(),
            'jobAttractive' => $jobAttractive,
            'news' => $news,
        ]);
    }

    // detal job
    public function detail($slug, $id)
    {
        $checklove = Favourite::where('job_id', $id)->first();
        if ($checklove) {
            $love = $checklove->job_id;
        } else {
            $love = null;
        }
        $job = Job::query()
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany', 'company.address as addressCompany', 'company.Desceibe as desceibeCompany', 'company.number_member as number_member', 'company.email as emailCompany')
            ->where('job.id', $id)
            ->first();
        //tin liên quan
        $data = Jobskill::query()
            ->whereIn('skill_id', $job->getskill->pluck('id'))
            ->whereNotIn('job_id', [$id])
            ->get()
            ->pluck('job_id');
        $relate = Job::query()
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->whereIn('job.id', $data)
            ->where('job.expired', 0)
            ->select('job.*', 'company.name as nameCompany', 'company.address as addressCompany', 'company.logo as logo')
            ->get();

        if (Auth::guard('user')->check()) {
            $cv = UploadCv::query()->where('user_id', Auth::guard('user')->user()->id)->get();
            $checkJob = SaveCv::query()->where([
                ['id_job', $id],
                ['user_id', Auth::guard('user')->user()->id],
                ['status', 0],
            ])->first();
            if ($checkJob) {
                if ($checkJob->id_job && $checkJob->status != 2) {
                    $checkJobTrue = 1;
                }
                if ($checkJob->id_job && $checkJob->status == 2) {
                    $checkJobTrue = 0;
                }
            } else {
                $checkJobTrue = 0;
            }
        }
        return view('jobDetail', [
            'job' => $job,
            'rules' => $relate,
            'cv' => $cv ?? '',
            'checklove' => $love,
            'checkJobTrue' => $checkJobTrue ?? 0,
        ]);
    }
    // upload cv
    public function upCv(Request $request)
    {
        $checkFilterUserApply = FilterApplyJob::query()->where('seeker_id', Auth::guard('user')->user()->id)->first();
        if ($checkFilterUserApply) {
            $this->setFlash(__('Bạn đã nằm trong danh sách bị cấm nộp cv vào cty chúng tôi'), 'error');
            return redirect()->back();
        }
        if (!Auth::guard('user')->check()) {
            $this->setFlash(__('Bạn cần đăng nhập hoặc đăng ký để trải nghiệm dịch vụ của chúng tôi'), 'error');
            return redirect()->back();
        }
        $checkJob = new SaveCv();
        if ($checkJob) {
            $cvSave = $checkJob;
            $cvUpload = $checkJob;
        } else {
            $cvSave = new UploadCv();
            $cvUpload = new SaveCv();
        }

        if (isset($request->file_cv)) {
            $user = User::query()->find(Auth::guard('user')->user()->id);
            if (count($user->getploadCv) == 2) {
                $this->setFlash(__('Số lượng cv của bạn thêm vào đã vượt mức cho phép, mỗi tài khoản chỉ được thêm mới tối đa 2 cv'), 'error');
                return redirect()->back();
            }
            if ($request->save_cv) {
                try {
                    $cvSave->title = $request->title;
                    $cvSave->user_id = Auth::guard('user')->user()->id;
                    $cvUpload->status = 0;
                    if ($request->hasFile('file_cv')) {
                        $cvSave->file_cv = $request->file_cv->storeAs('images/cv', $request->file_cv->hashName());
                    }
                    $cvSave->save();
                    //
                    $cvUpload->title = $request->title;
                    $cvUpload->token = rand(00000, 99999);
                    $cvUpload->user_id = Auth::guard('user')->user()->id;
                    if ($request->hasFile('file_cv')) {
                        $cvUpload->file_cv = $request->file_cv->storeAs('images/cv', $request->file_cv->hashName());
                    }
                    $cvUpload->id_job = $request->id_job;
                    $cvUpload->save();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return back();
                }
            } else {
                //
                $cvUpload->title = $request->title;
                $cvUpload->token = rand(00000, 99999);
                $cvUpload->user_id = Auth::guard('user')->user()->id;
                if ($request->hasFile('file_cv')) {
                    $cvUpload->file_cv = $request->file_cv->storeAs('images/cv', $request->file_cv->hashName());
                }
                $cvUpload->id_job = $request->id_job;
                $cvUpload->save();
            }
        } else {

            $cvSave = UploadCv::query()->find($request->cv_for_save);
            if ($cvSave) {
                $cvUpload->title = $cvSave->title;
                $cvUpload->token = rand(00000, 99999);
                $cvUpload->user_id = Auth::guard('user')->user()->id;
                $cvUpload->file_cv = $cvSave->file_cv;
                $cvUpload->status = 0;
                $cvUpload->id_job = $request->id_job;
                $cvUpload->save();
            }
        }
        event(new MailApplyJobEvent($request->id_job));
        $this->setFlash(__('Hãy chờ phản hồi của nhà tuyển dụng'));
        return redirect()->back();
    }
    // love cv
    public function getDatalove($id)
    {
        return response()->json([
            'data' => Favourite::where([
                ['job_id', $id],
                ['user_id', Auth::guard('user')->user()->id],
            ])->first()
        ]);
    }
    public function userFavouriteId($id)
    {
        $favourite = Favourite::select('*')->get();
        if ($favourite->where('user_id', Auth::guard('user')->user()->id)->whereIn('job_id', $id)->first()) {
            Favourite::where('job_id', $id)->delete();
            return response()->json([
                'status' => StatusCode::OK
            ]);
        }
        Favourite::create([
            'job_id' => $id,
            'user_id' => Auth::guard('user')->user()->id,
        ])->save();
        return response()->json([
            'status' => StatusCode::OK
        ]);
    }
    public function search(Request $request)
    {
        if (Auth::guard('user')->check()) {
            if ($request->key) {
                $checkKeySearch = KeyUserSearch::query()->where('key', $request->key)->first();
                if ($checkKeySearch) {
                    if ($checkKeySearch->key == $request->key) {
                        $keySearch = $checkKeySearch;
                        $keySearch->count += 1;
                    }
                } else {
                    $keySearch = new KeyUserSearch();
                    $keySearch->count = 1;
                }
                $keySearch->key = $request->key;
                $keySearch->user_id = Auth::guard('user')->user()->id;
                $keySearch->save();
            }
        }
        $that = $request;
        $data = Job::query()
            ->join('job_skill', 'job_skill.job_id', '=', 'job.id')
            ->join('skill', 'job_skill.skill_id', '=', 'skill.id')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->Where(function ($q) use ($that) {
                if (!empty($that->key)) {
                    $q->where('job.title', 'LIKE', '%' . $that->key . '%');
                }
                if (!empty($that->skill)) {
                    if (!empty($that->skill[0])) {
                        $q->whereIn('job_skill.skill_id', $that->skill);
                    }
                }
                if (!empty($that->location)) {
                    $q->Where(
                        'job.location_id',
                        $that->location
                    );
                }
                if (!empty($that->profession)) {
                    $q->Where(
                        'job.profession_id',
                        $that->profession
                    );
                }
                if (!empty($that->experience)) {
                    $q->Where(
                        'job.experience_id',
                        $that->experience
                    );
                }
                if (!empty($that->time_work)) {
                    $q->Where(
                        'job.time_work_id',
                        $that->timework
                    );
                }

                if (!empty($that->workingform)) {
                    $q->Where(
                        'job.wk_form_id',
                        $that->workingform
                    );
                }
                if (!empty($that->majors)) {
                    $q->Where(
                        'job.majors_id',
                        $that->majors
                    );
                }
                if (!empty($that->lever)) {
                    $q->Where(
                        'job.level_id',
                        $that->lever
                    );
                }
                if (!empty($that->wage)) {
                    $q->Where(
                        'job.wage_id',
                        $that->wage
                    );
                }
            })
            ->where([
                ['job.status', 1],
                ['job.expired', 0],
            ])
            ->with('getMajors')
            ->with('getWage')
            ->distinct()
            ->with('getTime_work')
            ->with('getlocation')
            ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany')
            ->orderBy('employer.prioritize', 'desc')
            ->get();
        return view('search', [
            'lever' => $this->getlever(),
            'experience' => $this->getexperience(),
            'wage' => $this->getwage(),
            'skill' => $this->getskill(),
            'timework' => $this->gettimework(),
            'profession' => $this->getprofession(),
            'majors' => $this->getmajors(),
            'location' => $this->getlocation(),
            'workingform' => $this->getworkingform(),
            'request' => $request->all(),
            'job' => $data,
        ]);
    }
}
