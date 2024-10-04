<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BonusPackagesResource\Pages;
use App\Filament\Resources\BonusPackagesResource\RelationManagers;
use App\Models\BonusPackageModel;
use App\Models\BonusPackages;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
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

class BonusPackagesResource extends Resource
{
    protected static ?string $model = BonusPackageModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                FileUpload::make('thumbnail')
                    ->disk('public')
                    ->directory('bonus-package')
                    ->image(),
                Textarea::make('about')->required(),
                TextInput::make('price')->numeric()->inputMode('decimal')->prefix('IDR')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('about')->wrap(),
                TextColumn::make('price')->money('IDR'),
                ImageColumn::make('thumbnail')
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
            'index' => Pages\ListBonusPackages::route('/'),
            'create' => Pages\CreateBonusPackages::route('/create'),
            'edit' => Pages\EditBonusPackages::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Bonus Packages'; // Singular form
    }
}
