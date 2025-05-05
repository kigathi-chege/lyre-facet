<?php

namespace Lyre\Facet\Http\Resources;

use Lyre\Facet\Models\Facet as FacetModel;
use Lyre\Resource;

class Facet extends Resource
{
    public function __construct(FacetModel $model)
    {
        parent::__construct($model);
    }
}
