<?php

namespace Lyre\Facet\Policies;

use Lyre\Facet\Models\FacetValue;
use App\Models\User;
use Lyre\Policy;

class FacetValuePolicy extends Policy
{
    public function __construct(FacetValue $model)
    {
        parent::__construct($model);
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, $model): bool
    {
        return true;
    }
}
