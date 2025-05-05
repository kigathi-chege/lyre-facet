<?php

namespace Lyre\Facet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Lyre\Model;

class Facet extends Model
{
    use HasFactory;

    const ID_COLUMN = 'slug';

    public function facetValues()
    {
        return $this->hasMany(FacetValue::class);
    }
}
