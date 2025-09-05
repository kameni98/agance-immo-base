<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    protected $fillable = ['name','description'];

    public function properties():BelongsToMany{
        return $this->belongsToMany(Property::class);
    }
}
