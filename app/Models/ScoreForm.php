<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreForm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function score_details() {
        return $this->hasMany(ScoreDetail::class);
    }

    public function score_values() {
        return $this->hasMany(ScoreValue::class, 'form_id');
    }

    public function score_type() {
        return $this->belongsTo(ScoreType::class, 'scoring_type_id');
    }
}
