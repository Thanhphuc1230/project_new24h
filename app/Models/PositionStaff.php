<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionStaff extends Model
{
    use HasFactory;
    protected $table = 'staff_position';

    protected $fillable = [
        'uuid',
        'position',
        'status_position',
    ];
}
