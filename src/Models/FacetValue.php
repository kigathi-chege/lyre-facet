<?php

namespace Lyre\Facet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Lyre\Model;

class FacetValue extends Model
{
    use HasFactory;

    const ID_COLUMN = 'slug';

    protected $with = ['facet'];

    protected $visible = ['facet_name'];

    public function facet()
    {
        return $this->belongsTo(Facet::class);
    }

    public function getFacetNameAttribute()
    {
        return $this->facet->name;
    }
}
