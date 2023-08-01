<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterApplyJob extends Model
{
    use HasFactory;
    protected $table = 'filter_apply';
    protected $fillable = [
        'id',
        'employer_id',
        'seeker_id',
        'content',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'seeker_id');
    }
}
