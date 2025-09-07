<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

//

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
    use HasFactory; //important si on veut utiliser des seeder
    /**
     * Global scope : cas du soft delete
     * ceci va nous permettre de ne pas supprimer définitivement des champs dans la BDD et pour cela on va ajouter le
     * champ "deleted_at" à la table relie au model actuel. On peut utiliser ceci dans un système de gestion où il faut
     * plusieurs signatures avant la suppresion définitive d'un document
     */
    use SoftDeletes;

    /**
     * CAST : il permet de changer le type d'un attribut par exple le sold est un boolean mais renvoi 0 ou 1 on le castant en bool cava
     * renvoyer un "true" ou "false"
     */
    protected function casts(): array
    {
        return [
            'sold' => 'bool'
        ];
    }

    /**
     * Accesseur : get
     * Mutateur ! set
     *
    protected function surface(): Attribute{
        return Attribute::make(
            get: fn (?string $value) => $value." m²", //permet de modifier un attribut avant son affichage
            //set: fn (string $value) => $value." m²" // permet de modifier un attribut avant son enregistrement dans la BDD
        );
    }
    */
    //champ qu'on peut remplir automatiquement avec la methode create et update
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

    /**
     * SCOPES
     * /un scope va nous permettre d'utiliser des bouts de requête et pouvoir les utiliser dans plusieurs endroits
     */
    //mettons un scope qui permet de sélectionner uniquement les propriétés disponibles
    public function scopeSolded(Builder $builder, bool $solded = true):Builder{
        return $builder->where('sold', $solded);
    }

    public function scopeRecent(Builder $builder):Builder{
        return $builder->orderBy('created_at', 'desc');
    }
}
