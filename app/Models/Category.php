<?php

namespace App\Models;

use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    
    public $transformer = CategoryTransformer::class;
    
    protected $fillable = [
        'name',
        'description'
    ];
    protected $hidden = [
        'deleted_at',
        'pivot'
    ];

    /**
     * Disable auto incrementing
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
