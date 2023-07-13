<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Lever;
use App\Models\location;
use App\Models\Majors;
use App\Models\Profession;
use App\Models\SaveCv;
use App\Models\Skill;
use App\Models\Timeoffer;
use App\Models\Timework;
use App\Models\Wage;
use App\Models\WorkingForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaseController extends Controller
{
    public function setFlash($message, $mode = 'success', $urlRedirect = '')
    {
        session()->forget('Message.flash');
        session()->push('Message.flash', [
            'message' => $message,
            'mode' => $mode,
            'urlRedirect' => $urlRedirect,

        ]);
    }
    public function gettimeoffer()
    {
        return $this->timeoffer->latest()->select('id', 'name as label')->get();
    }
    public function getlever()
    {
        return Lever::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getexperience()
    {
        return Experience::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getwage()
    {
        return Wage::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getskill()
    {
        return Skill::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function gettimework()
    {
        return Timework::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getprofession()
    {
        return Profession::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getmajors()
    {
        return Majors::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getlocation()
    {
        return location::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function getworkingform()
    {
        return WorkingForm::query()->latest()->select('id', 'name as label')
            ->get();
    }
    public function convertName($value)
    {
        $text = $value;
        $removedSpecialChars = preg_replace('/[^\pL\d\s]+/u', '', $text);

        $transliteratedText = Str::ascii($removedSpecialChars);
        $normalizedText = preg_replace('/\s+/', ' ', $transliteratedText);
        $hyphenatedText = str_replace(' ', '-', $normalizedText);

        return $hyphenatedText;
    }
    public function getDataMouth($request, $employer, $year)
    {
        $date = $year['year'] ?? Carbon::parse(Carbon::now())->format('Y');
        return SaveCv::query()
            ->join('job', 'job.id', '=', 'save_cv.id_job')
            ->join('employer', 'employer.id', '=', 'job.employer_id')
            ->where('job.employer_id', $employer)
            ->where(function ($q) use ($request, $date) {
                $q->whereMonth('save_cv.created_at', $request)
                    ->whereYear('save_cv.created_at', $date);
            })
            ->count();
    }
    public function escapeLikeSentence($column, $str, $before = true, $after = true)
    {
        $result = str_replace('\\', '[\]', $this->mbTrim($str)); // \ -> \\
        $result = str_replace('%', '\%', $result); // % -> \%
        $result = str_replace('_', '\_', $result); // _ -> \_

        return [[$column, 'LIKE', (($before) ? '%' : '') . $result . (($after) ? '%' : '')]];
    }
    public function mbTrim($string)
    {
        $whitespace = '[\s\0\x0b\p{Zs}\p{Zl}\p{Zp}]';
        $ret = preg_replace(sprintf('/(^%s+|%s+$)/u', $whitespace, $whitespace), '', $string);

        return $ret;
    }
}
