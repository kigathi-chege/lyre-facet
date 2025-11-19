<?php

namespace Lyre\Facet\Http\Controllers;

use Lyre\Facet\Models\Facet;
use Lyre\Facet\Repositories\Contracts\FacetRepositoryInterface;
use Lyre\Controller;
use Illuminate\Http\JsonResponse;

class FacetController extends Controller
{
    public function __construct(
        FacetRepositoryInterface $modelRepository
    ) {
        $model = new Facet();
        $modelConfig = $model->generateConfig();
        parent::__construct($modelConfig, $modelRepository);
    }

    /**
     * Get the facet hierarchy for the current tenant
     * Returns a tree structure of facets with their parent-child relationships
     */
    public function hierarchy(): JsonResponse
    {
        // Get root facets (no parent) for current tenant
        $rootFacets = Facet::roots()
            ->with(['children' => function ($query) {
                $query->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        // Build hierarchy tree recursively
        $buildTree = function ($facets) use (&$buildTree) {
            return $facets->map(function ($facet) use (&$buildTree) {
                $data = [
                    'id' => $facet->id,
                    'name' => $facet->name,
                    'slug' => $facet->slug,
                    'description' => $facet->description,
                    'parent_id' => $facet->parent_id,
                    'order' => $facet->order,
                    'depth' => $facet->ancestors()->count(),
                ];

                if ($facet->children->isNotEmpty()) {
                    $data['children'] = $buildTree($facet->children);
                }

                return $data;
            });
        };

        $hierarchy = $buildTree($rootFacets);

        return response()->json([
            'data' => $hierarchy,
        ]);
    }
}
