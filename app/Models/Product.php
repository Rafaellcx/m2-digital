<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected
        $table = 'products';

    protected
        $keyType = 'integer';

    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected
        $fillable = ['name', 'price', 'discount_id'];

    protected $casts = [
        'name' => 'string',
        'price' => 'float',
        'discount_id' => 'integer',
    ];

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class,'id','discount_id');
    }

    public function getDiscountValueAttribute(): float
    {
        return $this->discount ? $this->discount->value : 0;
    }
}
