<?php

namespace App\Filament\Resources\WeddingTestimonialsResource\Pages;

use App\Filament\Resources\WeddingTestimonialsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingTestimonials extends ListRecords
{
    protected static string $resource = WeddingTestimonialsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
