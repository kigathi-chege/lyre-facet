<?php

namespace Lyre\Facet\Http\Controllers;

use Lyre\Facet\Models\Facet;
use Lyre\Facet\Repositories\Contracts\FacetRepositoryInterface;
use Lyre\Controller;

class FacetController extends Controller
{
    public function __construct(
        FacetRepositoryInterface $modelRepository
    ) {
        $model = new Facet();
        $modelConfig = $model->generateConfig();
        parent::__construct($modelConfig, $modelRepository);
    }
}
