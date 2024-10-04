<?php

namespace App\Filament\Resources\WeddingTransactionsResource\Pages;

use App\Filament\Resources\WeddingTransactionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingTransactions extends EditRecord
{
    protected static string $resource = WeddingTransactionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
