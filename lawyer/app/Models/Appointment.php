<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'lawyer_id',
        'event_name',
        'event_start',
        'event_end',
        'user_id',
    ];
}
