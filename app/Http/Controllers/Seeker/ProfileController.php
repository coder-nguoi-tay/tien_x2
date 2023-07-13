<?php

namespace App\Http\Controllers\Seeker;

use App\Enums\StatusCode;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Jobseeker;
use App\Models\KeyUserSearch;
use App\Models\ProfileUserCv;
use App\Models\SaveCv;
use App\Models\SeekerSkill;
use App\Models\Skill;
use Database\Seeders\SkillSeeder;
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
        $apply = Job::query()
            ->where('save_cv.user_id', Auth::guard('user')->user()->id)
            ->leftjoin('save_cv', 'save_cv.id_job', '=', 'job.id')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->Orderby('save_cv.created_at', 'DESC')
            ->with('getMajors')
            ->select('job.id as id', 'job.location_id', 'job.majors_id', 'job.slug as slug', 'job.title as title', 'company.id as idCompany', 'company.logo as logo', 'company.name as nameCompany', 'save_cv.created_at as created_at', 'save_cv.status as status', 'save_cv.file_cv as file')
            ->get();
        $keySearch = KeyUserSearch::query()->where('user_id', Auth::guard('user')->user()->id)->orderBy('count', 'desc')->get();

        // 
        $jobSeeker = Jobseeker::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        // skill seeeker
        $SeekerId = SeekerSkill::query()->where('job-seeker_id', $jobSeeker->id)->pluck('skill_id');
        $skillSeeker = Skill::query()->whereIn('id', $SeekerId)->get();
        return view('seeker.index', [
            'profileCv' => $profileCv,
            'lever' => $this->getlever(),
            'experience' => $this->getexperience(),
            'wage' => $this->getwage(),
            'skill' => $this->getskill(),
            'majors' => $this->getmajors(),
            'location' => $this->getlocation(),
            'apply' => $apply,
            'keySearch' => $keySearch ?? [],
            'jobSeeker' => $jobSeeker ?? [],
            'skillSeeker' => $skillSeeker ?? [],
        ]);
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
    public function offStatus(Request $request)
    {
        try {
            $profile = ProfileUserCv::where('user_id', Auth::guard('user')->user()->id)->first();
            $profile->status = 0;
            $profile->save();
            return response()->json([
                'message' => 'Cập nhật thành công',
                'status' => StatusCode::OK
            ], StatusCode::OK);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollback();
            return response()->json([
                'message' => 'Đã có một lỗi xảy ra',
                'status' => StatusCode::FORBIDDEN,
            ], StatusCode::FORBIDDEN);
        }
    }
}
