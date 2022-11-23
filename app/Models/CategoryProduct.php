<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryProduct extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_product';

    /**
     * Primary keys
     * 
     * @var array
     */
    protected $primaryKey = ['category_id', 'product_id'];

    /**
     * Disable auto incrementing
     * 
     * @var bool
     */
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    /**
     * Get the product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the category of this product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
