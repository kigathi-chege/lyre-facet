<?php

namespace Lyre\Facet\Http\Resources;

use Lyre\Facet\Models\FacetValue as FacetValueModel;
use Lyre\Resource;

class FacetValue extends Resource
{
    public function __construct(FacetValueModel $model)
    {
        parent::__construct($model);
    }
}
