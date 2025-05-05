<?php

namespace Lyre\Facet\Repositories;

use Lyre\Repository;
use Lyre\Facet\Models\Facet;
use Lyre\Facet\Repositories\Contracts\FacetRepositoryInterface;

class FacetRepository extends Repository implements FacetRepositoryInterface
{
    protected $model;

    public function __construct(Facet $model)
    {
        parent::__construct($model);
    }
}
