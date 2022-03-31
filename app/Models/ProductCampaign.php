<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCampaign extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected
        $table = 'products_campaign';

    protected
        $keyType = 'integer';

    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected
        $fillable = ['product_id', 'campaign_id'];

    protected $casts = [
        'product_id' => 'integer',
        'campaign_id' => 'integer',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function campaign(): HasOne
    {
        return $this->hasOne(Campaign::class,'id','campaign_id');
    }

    public function getProductNameAttribute(): string
    {
        return $this->product ? $this->product->name : "";
    }

    public function getCampaignNameAttribute(): string
    {
        return $this->campaign ? $this->campaign->name : "";
    }
}
