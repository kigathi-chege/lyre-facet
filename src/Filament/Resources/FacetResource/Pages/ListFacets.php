<?php

namespace Lyre\Facet\Filament\Resources\FacetResource\Pages;

use Lyre\Facet\Filament\Resources\FacetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacets extends ListRecords
{
    protected static string $resource = FacetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
