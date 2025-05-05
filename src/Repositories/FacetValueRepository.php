<?php

namespace Lyre\Facet\Repositories;

use Lyre\Repository;
use Lyre\Facet\Models\FacetValue;
use Lyre\Facet\Repositories\Contracts\FacetValueRepositoryInterface;

class FacetValueRepository extends Repository implements FacetValueRepositoryInterface
{
    protected $model;

    public function __construct(FacetValue $model)
    {
        parent::__construct($model);
    }
}
