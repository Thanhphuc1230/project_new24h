<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'uuid',
        'title',
        'avatar',
        'intro',
        'content',
        'author',
        'uuid_author',
        'status',
        'where_in',
        'category_id',
        'new_view'
    ];

    protected $primaryKey = 'id_new';
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
