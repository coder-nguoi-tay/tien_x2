<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;
    protected $table = 'reason';
    protected $fillable = [
        'id',
        'job_id',
        'cv_id',
        'content'
    ];
}
