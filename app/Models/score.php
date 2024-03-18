<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class score extends Model
{
    use HasFactory;

    protected $table = 'score';

    protected $fillable=['user_scoreId', 'examType', 'score', 'exempted', 'added_by'];
}
