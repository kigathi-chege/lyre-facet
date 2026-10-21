<?php

namespace Lyre\Facet\Concerns;

use Illuminate\Database\Eloquent\Collection;
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

    /**
     * Replace the model's facet values with the given ones.
     *
     * Pass $onlyFacetIds to replace only the values of those facets and keep the rest (e.g. a
     * category picker must not remove an access tag set elsewhere). Without it every facet
     * value is replaced, as before.
     *
     * @param  int|int[]  $facetValueIds
     * @param  int[]|null  $onlyFacetIds
     * @return Collection<int, FacetedEntity>
     */
    public function attachFacetValues($facetValueIds, ?array $onlyFacetIds = null)
    {
        if (! is_array($facetValueIds)) {
            $facetValueIds = [$facetValueIds];
        }

        $existing = $this->facetedEntities();

        if ($onlyFacetIds !== null) {
            $existing->whereIn('facet_value_id', FacetValue::query()->whereIn('facet_id', $onlyFacetIds)->select('id'));
        }

        $existing->delete();

        return $this->facetedEntities()->createMany(array_map(fn ($facetValueId) => ['facet_value_id' => $facetValueId], array_values(array_unique($facetValueIds))));
    }
}
