<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property string $skill
 * @property string $certificate
 * @property string $target
 * @property string $work
 * @property string $work_detail
 * @property string $project
 * @property string $project_detail
 * @property string $created_at
 * @property string $updated_at
 */
class ProfileUserCv extends Model
{

    use HasFactory;
    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'profile_user_cv';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['email', 'address', 'phone', 'skill', 'about', 'level', 'project', 'user_id', 'status', 'link_fb', 'majors', 'status_profile', 'images', 'title', 'link_inta', 'created_at', 'updated_at', 'link_sky', 'link_tw'];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function Profile()
    {
        return $this->hasOne(Jobseeker::class, 'user_role', 'user_id');
    }
    public function employerPayment()
    {
        return $this->hasMany(EmployerPaymentCv::class, 'profile_cv_id', 'id');
    }
    public function feedback()
    {
        return $this->hasMany(FeedbackCv::class, 'profile_cv_id', 'id');
    }
    public function feedback2()
    {
        return $this->hasMany(FeedbackCv::class, 'profile_cv_id', 'id');
    }
    public function feedback3()
    {
        return $this->hasMany(FeedbackCv::class, 'profile_cv_id', 'id');
    }
}
