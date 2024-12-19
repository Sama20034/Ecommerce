<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function productphoto()
    {
        return $this->hasMany(productphoto::class);
    }
}
