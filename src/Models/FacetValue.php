<?php

namespace Lyre\Facet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Lyre\Model;

class FacetValue extends Model
{
    use HasFactory;

    const ID_COLUMN = 'slug';

    protected $with = ['facet'];

    public function facet()
    {
        return $this->belongsTo(Facet::class);
    }

    public function getFacetNameAttribute()
    {
        return $this->facet->name;
    }

    public static function includeSerializableColumns()
    {
        return ['facet_name'];
    }
}
