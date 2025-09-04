<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\FamilyFactory;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

   public function categories()
   {
       return $this->hasMany(Category::class);
   }
}
