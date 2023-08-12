<?php

namespace App\Http\Controllers\Seeker;

use App\Enums\StatusCode;
use App\Http\Controllers\BaseController;
use App\Models\Job;
use App\Models\Jobseeker;
use App\Models\KeyUserSearch;
use App\Models\ProfileUserCv;
use App\Models\SaveCv;
use App\Models\SeekerSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $apply = SaveCv::where('save_cv.user_id', Auth::guard('user')->user()->id)
            ->leftjoin('job', 'job.id', '=', 'save_cv.id_job')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('location', 'location.id', '=', 'job.location_id')
            ->join('majors', 'majors.id', '=', 'job.majors_id')
            ->join('company', 'company.id', '=', 'employer.id_company')
            ->Orderby('save_cv.created_at', 'DESC')
            ->select(
                'job.id as id',
                'job.slug as slug',
                'job.title as title',
                'company.id as idCompany',
                'company.logo as logo',
                'company.name as nameCompany',
                'save_cv.created_at as created_at',
                'save_cv.status as status',
                'save_cv.file_cv as file',
                'save_cv.id as id_save_cv',
                'location.name as location',
                'majors.name as majors',
            )
            ->get();
        $keySearch = KeyUserSearch::query()->where('user_id', Auth::guard('user')->user()->id)->orderBy('count', 'desc')->get();

        // 
        $jobSeeker = Jobseeker::query()->where('user_id', Auth::guard('user')->user()->id)->first();
        if ($jobSeeker) {
            $SeekerId = SeekerSkill::query()->where('job-seeker_id', $jobSeeker->id)->pluck('skill_id');
            $skillSeeker = Skill::query()->whereIn('id', $SeekerId)->get();
        }

        // số lượng ntd xem  hồ sơ

        $countEmployerSeeCv = SaveCv::query()->where([
            ['user_id', Auth::guard('user')->user()->id],
            ['status', '>=', 1],
        ])->get()->count();
        $user = Auth::guard('user')->user()->images;
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
            'countEmployerSeeCv' => $countEmployerSeeCv,
            'user' => $user,
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
            if ($checkSeeker) {
                SeekerSkill::query()->where('job-seeker_id', $checkSeeker->id)->delete();
            }
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
            DB::rollback();
            return response()->json([
                'message' => 'Đã có một lỗi xảy ra',
                'status' => StatusCode::FORBIDDEN,
            ], StatusCode::FORBIDDEN);
        }
    }
    public  function changePassword()
    {
        return  view('seeker.changePassword');
    }
    public  function changePasswordSucsses(Request  $request)
    {
        try {
            $user = User::query()->find(Auth::guard('user')->user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            $this->setFlash(_('Đổi mật khẩu thành công'));
            return redirect()->route('users.changePassword');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->setFlash(_('Đã có một lỗi xảy ra'));
            return redirect()->back();
        }
    }
    public function changeImage(Request $request)
    {
        try {
            $user = User::query()->find(Auth::guard('user')->user()->id);
            if ($request->hasFile('file_cv')) {
                $user->images = $request->file_cv->storeAs('images/cv', $request->file_cv->hashName());
            }
            $user->save();
            $this->setFlash(__('Thay đôi thành công!'));
            return back();
        } catch (\Throwable $th) {
            $this->setFlash(__('Đã có một lỗi xảy ra', 'error'));
            return back();
        }
    }
}
