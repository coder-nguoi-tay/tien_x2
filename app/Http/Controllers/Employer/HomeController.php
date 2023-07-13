<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AccountPayment;
use App\Models\Employer;
use App\Models\Job;
use App\Models\PaymentHistoryEmployer;
use App\Models\ProfileUserCv;
use App\Models\SaveCv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkCompany = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        // số  lượng bài viết đã đăng
        $job = Job::query()->where('employer_id', $checkCompany->id)->count();
        // số lương hồ sơ đã nhận
        $cv = SaveCv::query()
            ->join('job', 'job.id', '=', 'save_cv.id_job')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->where('job.employer_id', $checkCompany->id)
            ->count();
        // số lượng cv đã  mua
        $tatalecv = ProfileUserCv::query()->where('status', Auth::guard('user')->user()->id)->count();
        // tổng số tiền
        $totalPayment = AccountPayment::where('user_id', Auth::guard('user')->user()->id)->first();
        // lịch sử giao dịch
        $paymentHistory = PaymentHistoryEmployer::query()->where('user_id', $checkCompany->id)->limit(5)->orderBy('created_at', 'desc')->get();
        // Hồ sơ mới nhận gần đây
        $cvApplyNew = SaveCv::query()
            ->join('job', 'job.id', '=', 'save_cv.id_job')
            ->leftjoin('users', 'users.id', '=', 'save_cv.user_id')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->leftjoin('majors', 'majors.id', '=', 'job.majors_id')
            ->leftjoin('time_work', 'time_work.id', '=', 'job.time_work_id')
            ->where([
                ['employer.user_id', Auth::guard('user')->user()->id],
                // ['save_cv.status', 0],
            ])
            ->orderBy('save_cv.created_at', 'desc')
            ->select('job.id as job_id', 'users.name as user_name', 'users.images as images', 'save_cv.status as status', 'save_cv.id as cv_id', 'save_cv.file_cv as file_cv', 'save_cv.user_id as user_id', 'majors.name as majors_name', 'save_cv.created_at as create_at_sv', 'save_cv.token as token', 'time_work.name  as time_work_name')
            ->get();
        return view('employer.home', [
            'request' => $request->all(),
            'cv' => $cv ?? 0,
            'totalPayment' => $totalPayment ?? 0,
            'tatalecv' => $tatalecv ?? 0,
            'job' => $job ?? 0,
            'paymentHistory' => $paymentHistory ?? 0,
            'cvApplyNew' => $cvApplyNew ?? 0,
            'countCvMoth1' => $this->getDataMouth(1, $checkCompany->id, $request->all()),
            'countCvMoth2' => $this->getDataMouth(2, $checkCompany->id, $request->all()),
            'countCvMoth3' => $this->getDataMouth(3, $checkCompany->id, $request->all()),
            'countCvMoth4' => $this->getDataMouth(4, $checkCompany->id, $request->all()),
            'countCvMoth5' => $this->getDataMouth(5, $checkCompany->id, $request->all()),
            'countCvMoth6' =>  $this->getDataMouth(6, $checkCompany->id, $request->all()),
            'countCvMoth7' => $this->getDataMouth(7, $checkCompany->id, $request->all()),
            'countCvMoth8' => $this->getDataMouth(8, $checkCompany->id, $request->all()),
            'countCvMoth9' => $this->getDataMouth(9, $checkCompany->id, $request->all()),
            'countCvMoth10' => $this->getDataMouth(10, $checkCompany->id, $request->all()),
            'countCvMoth11' => $this->getDataMouth(11, $checkCompany->id, $request->all()),
            'countCvMoth12' => $this->getDataMouth(12, $checkCompany->id, $request->all()),
        ]);
    }
}
