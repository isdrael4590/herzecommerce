<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\VariantFactory;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'image_path',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function features()
    {
        return $this->belongsToMany(Feature::class)
                    ->withTimestamps();
    }
}
