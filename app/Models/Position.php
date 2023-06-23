<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'position';

    protected $fillable = [
        'uuid',
        'uuid_staff',
        'position_staff',
        'category_id',
        'status_position',
    ];
}
