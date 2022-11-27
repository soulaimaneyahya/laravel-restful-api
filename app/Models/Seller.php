<?php

namespace App\Models;

use App\Scopes\SellerScope;
use App\Transformers\SellerTransformer;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends User
{
    use HasFactory, HasUuids;

    public $transformer = SellerTransformer::class;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        static::addGlobalScope(new SellerScope);
        Parent::boot();
    }
}
