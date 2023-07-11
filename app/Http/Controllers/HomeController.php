<?php

namespace App\Http\Controllers;

use App\Enums\StatusCode;
use App\Mail\MailNotifyCV;
use App\Models\Company;
use App\Models\Favourite;
use App\Models\Job;
use App\Models\Jobseeker;
use App\Models\Jobskill;
use App\Models\location;
use App\Models\Majors;
use App\Models\SaveCv;
use App\Models\UploadCv;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = Majors::query()->get();

        $location = location::query()->get();

        $allJob = Job::query()->get();

        $jobForUser = Job::query()
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->where([
                ['job.status', 1],
                ['job.expired', 0],
                ['job.package_id_position', 1],
                ['employer.position', 1],
            ])
            ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany', 'company.address as addressCompany')
            ->orderBy('employer.prioritize', 'desc')
            ->get();
        if (Auth::guard('user')->check()) {
            $user = User::query()->with('getProfileUse')->where('id', Auth::guard('user')->user()->id)->first();

            if ($user->getProfileUse) {
                $getskill = Jobseeker::query()->with('getskill')->where('user_id', Auth::guard('user')->user()->id)->first();
                $skill_id = $getskill->getskill->pluck('id');
                $getProfile = $user->getProfileUse;
                $job = Job::query()
                    ->join('job_skill', 'job_skill.job_id', '=', 'job.id')
                    ->join('skill', 'job_skill.skill_id', '=', 'skill.id')
                    ->join('employer', 'employer.id', '=', 'job.employer_id')
                    ->join('company', 'company.id', '=', 'employer.id_company')
                    ->where([
                        ['job.status', 1],
                        ['job.expired', 0],
                        ['job.package_id_position', 1],
                        ['employer.position', 1],
                    ])
                    ->where(function ($query) use ($getProfile, $skill_id) {
                        $query->orWhere(function ($q) use ($skill_id) {
                            $q->whereIn('job_skill.skill_id', $skill_id);
                        })
                            ->orWhere(
                                'job.location_id',
                                $getProfile->location_id
                            )
                            ->orWhere(
                                'job.profession_id',
                                $getProfile->profession
                            )
                            ->orWhere(
                                'job.experience_id',
                                $getProfile->experience
                            )
                            ->orWhere(
                                'job.time_work_id',
                                $getProfile->time_work_id
                            )
                            ->orWhere(
                                'job.level_id',
                                $getProfile->lever_id
                            );
                    })
                    ->distinct()
                    ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany')
                    ->orderBy('employer.prioritize', 'desc')
                    ->get();
            } else {
                $job = $jobForUser;
            }
        } else {
            $job = $jobForUser;
        }
        // company
        $company = Company::query()->with('employer.job')->get();
        return view('index', [
            'majors' => $majors,
            'job' => $job,
            'location' => $location,
            'company' => $company,
            'countJob' => $allJob->count(),
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
                ['user_id', Auth::guard('user')->user()->id]
            ])->first();
            if ($checkJob) {
                if ($checkJob->id_job) {
                    $checkJobTrue = 1;
                } else {
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
        if (!Auth::guard('user')->check()) {
            $this->setFlash(__('Bạn cần đăng nhập hoặc đăng ký để trải nghiệm dịch vụ của chúng tôi'), 'error');
            return redirect()->back();
        }
        $checkJob = SaveCv::query()->where([
            ['id_job', $request->id_job],
            ['user_id', Auth::guard('user')->user()->id]
        ])->first();
        if ($checkJob) {
            $cvSave = $checkJob;
            $cvUpload = $checkJob;
        } else {
            $cvSave = new UploadCv();
            $cvUpload = new SaveCv();
        }

        if (isset($request->file_cv)) {
            if ($request->save_cv) {
                try {
                    $user = User::query()->find(Auth::guard('user')->user()->id);
                    if (count($user->getploadCv) == 2) {
                        $this->setFlash(__('Số lượng cv của bạn thêm vào đã vượt mức cho phép, mỗi tài khoản chỉ được thêm mới tối đa 2 cv'), 'error');
                        return redirect()->back();
                    } else {
                        $cvSave->title = $request->title;
                        $cvSave->user_id = Auth::guard('user')->user()->id;
                        $cvUpload->status = 0;
                        if ($request->hasFile('file_cv')) {
                            $cvSave->file_cv = $request->file_cv->storeAs('images/cv', $request->file_cv->hashName());
                        }
                        $cvSave->save();
                    }
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
        $emailCompany = Job::query()->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('users', 'users.id', '=', 'employer.user_id')
            ->select('users.email as email')->first();
        $firstJob = Job::query()->find($request->id_job);
        $mailContents = [
            'job' => $firstJob
        ];
        Mail::to($emailCompany->email)->send(new MailNotifyCV($mailContents));

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
                    if ($that->skill[0] != null) {
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
            ->select('job.*', 'company.logo as logo', 'company.id as idCompany', 'company.name as nameCompany')
            ->orderBy('employer.prioritize', 'desc')
            ->get();
        // liên quan
        $dataIdJob = [];
        foreach ($data as $value) {
            $dataIdJob[] = $value->id;
        }
        $datalq = Job::query()
            ->join('job_skill', 'job_skill.job_id', '=', 'job.id')
            ->join('skill', 'job_skill.skill_id', '=', 'skill.id')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->Where(function ($q) use ($that) {
                if (!empty($that->key)) {
                    $q->orWhere('job.title', 'LIKE', '%' . $that->key . '%');
                }
                if (!empty($that->skill)) {
                    if ($that->skill[0] != null) {
                        $q->orWhere(function ($q) use ($that) {
                            $q->whereIn('job_skill.skill_id', $that->skill);
                        });
                    }
                }
                if (!empty($that->location)) {
                    $q->orWhere(
                        'job.location_id',
                        $that->location
                    );
                }
                if (!empty($that->profession)) {
                    $q->orWhere(
                        'job.profession_id',
                        $that->profession
                    );
                }
                if (!empty($that->experience)) {
                    $q->orWhere(
                        'job.experience_id',
                        $that->experience
                    );
                }
                if (!empty($that->timework)) {
                    $q->orWhere(
                        'job.time_work_id',
                        $that->timework
                    );
                }

                if (!empty($that->workingform)) {
                    $q->orWhere(
                        'job.wk_form_id',
                        $that->workingform
                    );
                }
                if (!empty($that->majors)) {
                    $q->orWhere(
                        'job.majors_id',
                        $that->majors
                    );
                }
                if (!empty($that->lever)) {
                    $q->orWhere(
                        'job.level_id',
                        $that->lever
                    );
                }
            })
            ->where([
                ['job.status', 1],
                ['job.expired', 0],
            ])
            ->whereNotIn('job.id', $dataIdJob)
            ->distinct()
            ->with(['getLevel', 'getExperience', 'getWage', 'getprofession', 'getlocation', 'getMajors', 'getwk_form', 'getTime_work', 'getskill'])
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
            'datalq' => $datalq,
        ]);
    }
}
