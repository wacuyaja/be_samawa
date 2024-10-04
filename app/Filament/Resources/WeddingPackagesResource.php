<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingPackagesResource\Pages;
use App\Filament\Resources\WeddingPackagesResource\RelationManagers;
use App\Models\BonusPackageModel;
use App\Models\WeddingPackageModel;
use App\Models\WeddingPackages;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingPackagesResource extends Resource
{
    protected static ?string $model = WeddingPackageModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')->schema([

                    TextInput::make('name')->required()->maxLength(255),
                    FileUpload::make('thumbnail')->image()->required()->disk('public')->directory('wp-thumbnail'),
                    Repeater::make('photos')
                        ->relationship('photos')
                        ->schema([
                            FileUpload::make('photo')->image()->required()->disk('public')->directory('wp-photos')
                        ]),
                    Repeater::make('weddingBonusPackages')
                        ->relationship('weddingBonusPackages')
                        ->schema([
                            Select::make('bonus_package_id')
                                ->label('Bonus Package')
                                ->options(BonusPackageModel::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                        ])
                ]),
                Fieldset::make('additional')->schema([
                    Textarea::make('about')->required(),
                    TextInput::make('price')->required()->numeric()->inputMode('decimal')->prefix('IDR'),
                    Select::make('is_popular')->required()->options([
                        true => 'Popular',
                        false => 'Not Popular'
                    ]),
                    Select::make('city_id')->relationship('city', 'name')->searchable()->preload()->required(),
                    Select::make('wedding_organizer_id')->relationship('weddingOrganizer', 'name')->searchable()->preload()->required()
                ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('weddingOrganizer.name')->searchable(),
                ImageColumn::make('thumbnail'),
                IconColumn::make('is_popular')->boolean()->trueColor('success')->falseColor('danger')->trueIcon('heroicon-o-check-circle')->falseIcon('heroicon-o-x-circle')->label('Popular')
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
            'index' => Pages\ListWeddingPackages::route('/'),
            'create' => Pages\CreateWeddingPackages::route('/create'),
            'edit' => Pages\EditWeddingPackages::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Wedding Packages';
    }
}
