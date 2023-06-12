<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
        'clock_in' => 'datetime:d-m-Y H:i:s',
        'clock_out' => 'datetime:d-m-Y H:i:s',
        'working_hour' => 'datetime:d-m-Y H:i:s',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    
}
