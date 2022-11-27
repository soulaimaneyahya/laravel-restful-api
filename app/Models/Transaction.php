<?php

namespace App\Models;

use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    public $transformer = TransactionTransformer::class;

    protected $fillable = [
        'transaction_no',
        'product_id',
        'quantity',
        'buyer_id',
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = [
        'deleted_at'
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

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
