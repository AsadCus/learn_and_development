<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreValue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function score_form() {
        return $this->belongsTo(ScoreForm::class, 'form_id');
    }
}
