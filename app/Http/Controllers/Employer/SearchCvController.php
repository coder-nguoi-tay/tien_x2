<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AccountPayment;
use App\Models\Employer;
use App\Models\EmployerPaymentCv;
use App\Models\Feedback;
use App\Models\FeedbackCv;
use App\Models\PaymentHistoryEmployer;
use App\Models\ProfileUserCv;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchCvController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cv = ProfileUserCv::query()
            ->leftjoin('job-seeker', 'job-seeker.user_id', '=', 'profile_user_cv.user_id')
            ->leftjoin('seeker_skill', 'seeker_skill.job-seeker_id', '=', 'job-seeker.id')
            ->leftjoin('skill', 'skill.id', '=', 'seeker_skill.skill_id')
            ->where([
                ['profile_user_cv.status', 1],
            ])
            ->where(function ($q) use ($request) {
                if (!empty($request['name'])) {
                    $q->Where($this->escapeLikeSentence('majors', $request['free_word']));
                }
                if (!empty($request['location'])) {
                    $q->Where('job-seeker.location_id', $request['location']);
                }
                if (!empty($request['majors'])) {
                    $q->Where('job-seeker.majors_id', $request['majors']);
                }
                if (!empty($request['experience'])) {
                    $q->Where('job-seeker.experience_id', $request['experience']);
                }
                if (!empty($request->skill[0])) {
                    $q->WhereIn('seeker_skill.skill_id', $request['skill']);
                }
            })
            ->select('profile_user_cv.*')
            ->distinct()
            ->with('user')->get();
        if ($request->skill != null) {
            $skill = explode(',', $request->skill[0]);
            $skillSearch = Skill::query()->whereIn('id', $skill)->get();
        }
        return view('employer.cv.index', [
            'cv' => $cv,
            'wage' => $this->getwage(),
            'skill' => $this->getskill(),
            'majors' => $this->getmajors(),
            'location' => $this->getlocation(),
            'experience' => $this->getexperience(),
            'request' => $request->all(),
            'skillSearch' => $skillSearch ?? null,
        ]);
    }
    public function show($id)
    {
        $employer =  Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first()->id;
        $accPayment = AccountPayment::where('user_id', Auth::guard('user')->user()->id)->first();
        $cv = ProfileUserCv::where('profile_user_cv.id', $id)->with('user')
            ->withCount(['feedback' => function ($q) {
                $q->where('feedback_id', 1);
            }])
            ->withCount(['feedback3' => function ($q) {
                $q->where('feedback_id', 3);
            }])
            ->first();
        $countFeedBackEmployer = FeedbackCv::query()->where('employer_id', $employer)->where('profile_cv_id', $id)->first();
        $paymentCv = EmployerPaymentCv::query()->where('employer_id', $employer)->first();
        $feedback_cv = FeedbackCv::where('profile_cv_id', $id)->with('employer.getCompany')->with('feedback')->get();
        return view('employer.cv.show', [
            'cv' => $cv,
            'feedback_cv' => $feedback_cv,
            'accPayment' => $accPayment,
            'paymentCv' => $paymentCv ? $paymentCv->count() : 0,
            'countFeedBackEmployer' => $countFeedBackEmployer ? $countFeedBackEmployer->count() : 0,
            'feedbackAll' => Feedback::all(),
        ]);
    }
    public function showCvBought()
    {
        $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        $cv = EmployerPaymentCv::query()->where('employer_id', $employer->id)->with('profileCv')->get();
        return view('employer.cv.cvbought', [
            'cv' => $cv
        ]);
    }
    public function paymentCv(Request $request)
    {
        try {
            $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
            $account = AccountPayment::where('user_id', Auth::guard('user')->user()->id)->first();
            if (!$account) {
                $this->setFlash(__('nạp tiền vào tài khoản để sử dụng dịch vụ'), 'error');
                return back();
            }
            if ($account->surplus < $request->price) {
                $this->setFlash(__('Tài khoản của bạn không đủ để mua hàng'), 'error');
                return back();
            }
            $account->surplus -= $request->price;
            $account->save();
            //muacv
            $paymentCv = new EmployerPaymentCv();
            $paymentCv->profile_cv_id = $request->profile_id;
            $paymentCv->employer_id = $employer->id;
            $paymentCv->save();
            //lsgd
            $upcv = ProfileUserCv::where('id', $request->profile_id)->first();
            $paymentHistory = new PaymentHistoryEmployer();
            $paymentHistory->user_id = $employer->id;
            $paymentHistory->price = $request->price;
            $paymentHistory->desceibe = 'Thanh toán mua CV ' . $upcv->name;
            $paymentHistory->form = '';
            $paymentHistory->status = 1;
            $paymentHistory->save();
            $this->setFlash(__('Mua hồ sơ thành công'));
            return back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            $this->setFlash(__('đã có lỗi xảy ra xin thực hiện lại'), 'error');
            return back();
        }
    }
    public function feedback(Request $request)
    {
        $employer = Employer::where('user_id', Auth::guard('user')->user()->id)->first();
        try {
            $feedback = new FeedbackCv();
            $feedback->comment = $request->comment;
            $feedback->feedback_id = $request->feedback;
            $feedback->profile_cv_id = $request->profile_id;
            $feedback->employer_id = $employer->id;
            $feedback->save();
            $this->setFlash(__('Cảm ơn bạn đã đánh giá hồ sơ của chúng tôi'));
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            $this->setFlash(__('Đã có một lỗi không xác định xảy ra'), 'error');
            return redirect()->back();
        }
    }
}
