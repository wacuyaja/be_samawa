<?php

namespace App\Filament\Resources\WeddingTestimonialsResource\Pages;

use App\Filament\Resources\WeddingTestimonialsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingTestimonials extends EditRecord
{
    protected static string $resource = WeddingTestimonialsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
