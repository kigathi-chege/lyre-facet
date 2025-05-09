<?php

namespace Lyre\Facet\Concerns;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Lyre\Facet\Models\FacetedEntity;
use Lyre\Facet\Models\FacetValue;

trait HasFacet
{
    public function facetedEntities(): MorphMany
    {
        return $this->morphMany(FacetedEntity::class, 'entity');
    }

    public function facetValues(): HasManyThrough
    {
        return $this->hasManyThrough(
            FacetValue::class,
            FacetedEntity::class,
            'entity_id',        // Foreign key on faceted_entities table...
            'id',               // Foreign key on facet_values table...
            'id',               // Local key on the articles table...
            'facet_value_id'    // Local key on the faceted_entities table...
        )->where('entity_type', self::class);
    }
}
