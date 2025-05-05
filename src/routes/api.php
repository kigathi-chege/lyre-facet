<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')
    ->middleware(\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class)
    ->group(function () {
        Route::apiResources([
            'facets' => \Lyre\Facet\Http\Controllers\FacetController::class,
            'facetvalues' => \Lyre\Facet\Http\Controllers\FacetValueController::class,
        ]);
    });
