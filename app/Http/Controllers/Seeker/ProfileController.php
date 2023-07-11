<?php

namespace App\Http\Controllers\Seeker;

use App\Enums\StatusCode;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Jobseeker;
use App\Models\ProfileUserCv;
use App\Models\SeekerSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profileCv =  ProfileUserCv::where('user_id', Auth::guard('user')->user()->id)->first();
        return view('seeker.index', [
            'profileCv' => $profileCv,
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
        //
    }
    public function onStatus(Request $request)
    {
        try {
            $skill = explode(',', $request->skill[0]);
            $checkSeeker = Jobseeker::query()->where('user_id', Auth::guard('user')->user()->id)->first();
            if ($checkSeeker) {
                $search = $checkSeeker;
            } else {
                $search = new Jobseeker();
            }
            $search->user_id = Auth::guard('user')->user()->id;
            $search->experience_id = $request->experience;
            $search->wage_id = $request->wage;
            $search->location_id = $request->location;
            $search->majors_id = $request->majors;
            $search->save();
            $profile = ProfileUserCv::where('user_id', Auth::guard('user')->user()->id)->first();
            $profile->status = 1;
            $profile->save();
            // kỹ năng
            $array = [];
            foreach ($skill as $item) {
                $array[] = [
                    'job-seeker_id' => $search->id,
                    'skill_id' => $item,
                ];
            }
            SeekerSkill::query()->insert($array);
            $this->setFlash(__('Bật tìm việc thành công!'));
            return back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            $this->setFlash(__('Đã có một lỗi xảy ra'), 'error');
            return back();
        }
    }
}
