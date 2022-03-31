<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected
        $table = 'groups';

    protected
        $keyType = 'integer';

    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected
        $fillable = ['name', 'campaign_id'];

    protected $casts = [
        'name' => 'string',
        'campaign_id' => 'integer',
    ];

    public function campaign(): HasOne
    {
        return $this->hasOne(Campaign::class, 'id' ,'campaign_id',);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function getCampaignNameAttribute(): string
    {
        return $this->campaign ? $this->campaign->name : "";
    }
}
