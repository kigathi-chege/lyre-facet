<?php

namespace Lyre\Facet\Http\Controllers;

use Lyre\Facet\Models\FacetValue;
use Lyre\Facet\Repositories\Contracts\FacetValueRepositoryInterface;
use Lyre\Controller;

class FacetValueController extends Controller
{
    public function __construct(
        FacetValueRepositoryInterface $modelRepository
    ) {
        $model = new FacetValue();
        $modelConfig = $model->generateConfig();
        parent::__construct($modelConfig, $modelRepository);
    }
}
