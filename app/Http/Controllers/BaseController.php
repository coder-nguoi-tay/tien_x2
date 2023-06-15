<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Lever;
use App\Models\location;
use App\Models\Majors;
use App\Models\Profession;
use App\Models\Skill;
use App\Models\Timeoffer;
use App\Models\Timework;
use App\Models\Wage;
use App\Models\WorkingForm;
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
}
