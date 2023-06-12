<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
        
    protected $casts = [
        'start_date' => 'datetime:d-m-Y H:i:s',
        'end_date' => 'datetime:d-m-Y H:i:s',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function document() {
        return $this->hasMany(Document::class);
    }
    
    public function scores() {
        return $this->hasMany(Score::class);
    }

    public function supervisor() {
        return $this->belongsTo(Supervisor::class);
    }
    
    public function institute() {
        return $this->belongsTo(institute::class);
    }
}
