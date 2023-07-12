<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyUserSearch extends Model
{
    use HasFactory;
    protected $table = 'key_user_search';
    protected $fillable = [
        'id',
        'key',
        'user_id',
        'count',
    ];
   
}
