<?php

namespace Lyre\Facet\Policies;

use Lyre\Facet\Models\Facet;
use App\Models\User;
use Lyre\Policy;

class FacetPolicy extends Policy
{
    public function __construct(Facet $model)
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
