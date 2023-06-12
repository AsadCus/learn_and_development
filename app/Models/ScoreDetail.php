<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreDetail extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function score()
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    public function score_form() {
        return $this->belongsTo(ScoreForm::class, 'form_id');
    }

    public function score_value() {
        return $this->belongsTo(ScoreValue::class, 'value_id');
    }
}
