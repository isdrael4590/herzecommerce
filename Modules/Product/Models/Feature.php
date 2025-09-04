<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\FeatureFactory;

class Feature extends Model
{

    use HasFactory;
    protected $fillable = [
        'value',
        'description',
        'option_id',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    // relacion muchos a muchos variantes
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
                    ->withTimestamps();
    }
}
