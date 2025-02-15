<?php

namespace Modules\ProductFeature\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ProductFeature\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // protected static function newFactory(): CategoryFactory
    // {
    //     // return CategoryFactory::new();
    // }
}
