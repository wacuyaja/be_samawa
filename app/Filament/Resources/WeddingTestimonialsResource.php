<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingTestimonialsResource\Pages;
use App\Filament\Resources\WeddingTestimonialsResource\RelationManagers;
use App\Models\WeddingTestimonialModel;
use App\Models\WeddingTestimonials;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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

class WeddingTestimonialsResource extends Resource
{
    protected static ?string $model = WeddingTestimonialModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->string()->required(),
                TextInput::make('occupation')->string()->required(),
                FileUpload::make('photo')->image()->disk('public')->directory('wedding-testimonials'),
                Select::make('wedding_package_id')->relationship('weddingPackage', 'name')->searchable()->preload()->required(),
                Textarea::make('message')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('occupation'),
                TextColumn::make('weddingPackage.name'),
                TextColumn::make('message'),
                ImageColumn::make('photo'),

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
            'index' => Pages\ListWeddingTestimonials::route('/'),
            'create' => Pages\CreateWeddingTestimonials::route('/create'),
            'edit' => Pages\EditWeddingTestimonials::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Wedding Testimonials';
    }
}
