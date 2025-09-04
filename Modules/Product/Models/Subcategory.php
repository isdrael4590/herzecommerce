<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\SubcategoryFactory;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
