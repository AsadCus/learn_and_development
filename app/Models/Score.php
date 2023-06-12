<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'scoring_by_user_id');
    }

    public function score_details() {
        return $this->hasMany(ScoreDetail::class);
    }
}
