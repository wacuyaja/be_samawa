<?php

namespace App\Filament\Resources\WeddingPackagesResource\Pages;

use App\Filament\Resources\WeddingPackagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingPackages extends ListRecords
{
    protected static string $resource = WeddingPackagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
