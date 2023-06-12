<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function score_forms() {
        return $this->hasMany(ScoreForm::class, 'scoring_type_id');
    }
}
