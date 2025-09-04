<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family_id',
    ];
    
    public function family()
    {
        return $this->belongsTo(Family::class);
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
