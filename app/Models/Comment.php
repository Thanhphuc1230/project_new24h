<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'comment',
        'user_id_comment',
        'status_comment',
        'post_id_comment'
    ];

    protected $table = 'comments';

    protected $primaryKey = 'id_comment';
}
