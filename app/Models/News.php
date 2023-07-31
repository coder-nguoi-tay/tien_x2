<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'id',
        'title',
        'majors_id',
        'new_image',
        'describe',
        'status',
    ];
    public function majors()
    {
        return $this->hasOne(Majors::class, 'id', 'majors_id');
    }
}