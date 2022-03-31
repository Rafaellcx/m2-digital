<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected
        $table = 'campaigns';

    protected
        $keyType = 'integer';

    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected
        $fillable = ['name'];

    protected $casts = [
        'name' => 'string',
    ];

    public function productsCampaign(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'products_campaign','campaign_id','product_id')
            ->as('campaignProducts')->withPivot('id');
    }
//
//    public function getGroupNameAttribute()
//    {
//        return $this->group->name;
//    }
//    public function groups(): BelongsToMany
//    {
//        return $this->belongsToMany(Group::class,'campaigns_groups','campaign_id', 'group_id')
//            ->as('CampaignGroup')->withPivot('id', 'active');
//    }
}
