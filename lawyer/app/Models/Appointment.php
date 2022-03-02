<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'start',
        'end',
        'lawyer_id',
        'user_id',
        'color'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
