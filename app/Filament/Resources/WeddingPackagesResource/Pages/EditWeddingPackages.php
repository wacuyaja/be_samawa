<?php

namespace App\Filament\Resources\WeddingPackagesResource\Pages;

use App\Filament\Resources\WeddingPackagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingPackages extends EditRecord
{
    protected static string $resource = WeddingPackagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
