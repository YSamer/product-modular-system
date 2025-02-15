<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\ProductFeature\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'discount',
        'image2',

    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
