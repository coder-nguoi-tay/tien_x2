<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AccuacyRequest;
use App\Models\Accuracy;
use App\Models\Company;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileCompanyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employer =  Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        if ($employer->id_company) {
            $company = Company::query()->find($employer->id_company);
        }
        return view('employer.company.index', [
            'company' => $company ?? null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
            $Checkompany = Company::where('id', $employer->id_company)->first();
            if ($Checkompany) {
                $company = $Checkompany;
            } else {
                $company = new Company();
            }
            $company->name = $request->name;
            $company->number_tax = $request->number_tax;
            $company->address = $request->address;
            $company->desceibe = $request->desceibe;
            $company->number_member = $request->number_member;
            $company->email = $request->email;
            if ($request->hasFile('logo')) {
                $company->logo = $request->logo->storeAs('images/cv', $request->logo->hashName());
            }
            $company->save();
            $employer->id_company = $company->id;
            $employer->save();
            $this->setFlash(__('Cập nhật thông tin thành công!'));
            return redirect()->route('employer.company.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            $this->setFlash(__('Đã có một lỗi không các định xảy ra'), 'error');
            return redirect()->back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function business()
    {
        $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        $ImageAccuracy = Accuracy::query()->where('user_id', $employer->id_company)->first();
        return view('employer.company.business', [
            'accuracy' => $ImageAccuracy
        ]);
    }
    public function ImageAccuracy(AccuacyRequest $request)
    {
        $employer = Employer::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        if (!$employer->id_company) {
            $this->setFlash(__('Bạn chưa cập nhật thông tin công ty!'), 'error');
            return redirect()->back();
        }
        try {
            $company = Company::where('id', $employer->id_company)->first();
            if ($company->accuracy) {
                $accy = $company->accuracy;
            } else {
                $accy = new Accuracy();
            }
            $accy->user_id = $company->id;
            $accy->status = 0;
            if ($request->hasFile('images')) {
                $accy->images = $request->images->storeAs('images/cv', $request->images->hashName());
            }
            $accy->save();
            $this->setFlash(__('Chúng tôi sẽ xác nhận cho bạn sớm nhất có thể'));
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            $this->setFlash(__('Đã có một lỗi không xác định xảy ra'), 'error');
            return redirect()->back();
        }
    }
}
