<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User  extends Model
{
    use HasFactory;
    protected  $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'name',
        'role_id',
        'status',
        'images',
        'slug'
    ];
    protected $hidden = [
        'password',
        'token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getProfile()
    {
        return $this->hasOne(Employer::class, 'user_id', 'id');
    }
    public function getProfileUse()
    {
        return $this->hasOne(Jobseeker::class, 'user_id', 'id');
    }
    public function getskill()
    {
        return $this->belongsToMany(Skill::class, SeekerSkill::class,  'job-seeker_id', 'skill_id', 'id');
    }
    public function getploadCv()
    {
        return $this->hasMany(UploadCv::class, 'user_id', 'id');
    }
    public function getCheckUser()
    {
        return $this->hasOne(ProfileUserCv::class, 'user_id', 'id');
    }
}
