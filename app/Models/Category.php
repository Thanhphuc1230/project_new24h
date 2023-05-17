<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    use HasFactory;

    protected $fillable = [
        'name_cate',
        'uuid',
        'status_cate',
        'parent_id',
    ];
    //This function is used to create, not in the updated column
    public $timestamps = true;
    const UPDATED_AT = null;

}
