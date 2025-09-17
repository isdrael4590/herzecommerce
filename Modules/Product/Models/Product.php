<?php

namespace Modules\Product\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


// use Modules\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'subcategory_id',
    ];

   public function subcategory()
   {
       return $this->belongsTo(Subcategory::class);
   }
    public function variants()
    {
         return $this->hasMany(Variant::class);
    }
    public function options()
    {
         return $this->belongsToMany(Option::class)
                     ->withPivot('value')
                     ->withTimestamps();
    }
       protected static function newFactory()
    {
        return ProductFactory::new();
    }
}
