<?php

namespace App\Filament\Resources\BonusPackagesResource\Pages;

use App\Filament\Resources\BonusPackagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBonusPackages extends ListRecords
{
    protected static string $resource = BonusPackagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
