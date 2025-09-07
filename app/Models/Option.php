<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory; //important si on veut utiliser des seeder

    protected $fillable = ['name','description'];

    public function properties():BelongsToMany{
        return $this->belongsToMany(Property::class);
    }
}
