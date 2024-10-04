<?php

namespace App\Filament\Resources\WeddingTransactionsResource\Pages;

use App\Filament\Resources\WeddingTransactionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingTransactions extends ListRecords
{
    protected static string $resource = WeddingTransactionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
