<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingOrganizerResource\Pages;
use App\Filament\Resources\WeddingOrganizerResource\RelationManagers;
use App\Models\WeddingOrganizer;
use App\Models\WeddingOrganizerModel;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Nette\Utils\Strings;

class WeddingOrganizerResource extends Resource
{
    protected static ?string $model = WeddingOrganizerModel::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('phone')->numeric()->required(),
                FileUpload::make('icon')
                    ->disk('public')
                    ->directory('wo-icons')
                    ->required()
                    ->image()
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('wo-icon-'),
                    )
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('phone')->searchable(),
                ImageColumn::make('icon')->disk('public')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeddingOrganizers::route('/'),
            'create' => Pages\CreateWeddingOrganizer::route('/create'),
            'edit' => Pages\EditWeddingOrganizer::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Wedding Organizer'; // Singular form
    }
}
