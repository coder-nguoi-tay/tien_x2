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
    public function index()
    {
        $cv = ProfileUserCv::query()->where('status', 1)->get();
        return view('employer.cv.index', [
            'cv' => $cv
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employer = Employer::query()->find(Auth::guard('user')->user()->id)->id;
        $accPayment = AccountPayment::where('user_id', Auth::guard('user')->user()->id)->first();
        $cv = ProfileUserCv::where('profile_user_cv.id', $id)->with('user')
            ->withCount(['feedback' => function ($q) {
                $q->where('feedback_id', 1);
            }])
            ->withCount(['feedback3' => function ($q) {
                $q->where('feedback_id', 3);
            }])
            ->first();
        $countFeedBackEmployer = FeedbackCv::query()->where('employer_id', Auth::guard('user')->user()->id)->first();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showCvBought()
    {
        $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        $cv = EmployerPaymentCv::query()->where('employer_id', $employer->id)->with('user')->get();
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
