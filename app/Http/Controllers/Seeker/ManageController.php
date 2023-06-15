<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\SaveCv;
use App\Models\UploadCv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cv = UploadCv::query()->where('user_id', '=', Auth::guard('user')->user()->id)->get();
        return view('seeker.cv.index', [
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
        return view('seeker.cv.create');
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
            $upload = new UploadCv();
            $upload->user_id = Auth::guard('user')->user()->id;
            $upload->title = $request->title;
            if ($request->hasFile('file_cv')) {
                $upload->file_cv = $request->file_cv->storeAs('images/cv', $request->file_cv->hashName());
            }
            $upload->save();
            $this->setFlash(__('Thêm cv mới thành công'));
            return redirect()->route('users.file.index');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            $this->setFlash(__('đã có một lỗi không rõ nguyên nhân xảy ra'), 'error');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UploadCv::destroy($id);
        return redirect()->back();
    }
    // công việc đã ứng tuyển
    public function apply()
    {
        $apply = SaveCv::where('save_cv.user_id', Auth::guard('user')->user()->id)
            ->leftjoin('job', 'job.id', '=', 'save_cv.id_job')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->Orderby('save_cv.created_at', 'DESC')
            ->select('job.id as id', 'job.slug as slug', 'job.title as title', 'company.id as idCompany', 'company.logo as logo', 'company.name as nameCompany', 'save_cv.created_at as created_at', 'save_cv.status as status', 'save_cv.file_cv as file')
            ->get();

        return view('seeker.apply.index', [
            'apply' => $apply
        ]);
    }
    // công việc đã yêu thích
    public function love()
    {
        $love = Favourite::query()->where('favourite.user_id', Auth::guard('user')->user()->id)
            ->leftjoin('job', 'job.id', '=', 'favourite.job_id')
            ->leftjoin('wage', 'wage.id', '=', 'job.wage_id')
            ->leftjoin('location', 'location.id', '=', 'job.location_id')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->Orderby('favourite.created_at', 'DESC')
            ->select('job.id as id', 'job.slug as slug', 'job.title as title', 'company.id as idCompany', 'company.logo as logo', 'company.name as nameCompany', 'favourite.created_at as created_at', 'wage.name as namewage','location.name as nameLocation')
            ->get();
        return view('seeker.love.index', [
            'love' => $love,
        ]);
    }
}
