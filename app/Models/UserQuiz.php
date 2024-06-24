<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserQuiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
