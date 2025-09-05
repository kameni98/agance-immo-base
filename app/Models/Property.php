<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property string $price
 * @property int $surface
 * @property int $rooms
 * @property int $bedrooms
 * @property int|null $floor
 * @property string|null $postal_code
 * @property int $city_id
 * @property int $sold
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereSurface($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
    //
    protected $fillable = ['city_id', 'title', 'address', 'bedrooms', 'floor', 'postal_code', 'description','rooms','price','surface','sold'];

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo{
        return $this->belongsTo(City::class);
    }

    public function options():BelongsToMany{
        return $this->belongsToMany(Option::class);
    }

    public function getSlug():string{
        return \Str::slug($this->title);
    }
    /*// In your Eloquent Model
    public function setSoldAttribute($value): void
    {
        $this->attributes['sold'] = is_null($value) ? 0 : 1;
    }*/
}
