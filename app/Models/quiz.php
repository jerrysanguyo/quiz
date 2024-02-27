<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;

    protected $table='quiz';

    protected $fillable=[
        'user_id',
        'question_id',
        'answer',
        'result',
        'time_spent'
    ];
}
