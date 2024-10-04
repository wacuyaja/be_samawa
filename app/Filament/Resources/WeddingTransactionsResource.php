<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingTransactionsResource\Pages;
use App\Filament\Resources\WeddingTransactionsResource\RelationManagers;
use App\Models\WeddingPackageModel;
use App\Models\WeddingTransactionModel;
use App\Models\WeddingTransactions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingTransactionsResource extends Resource
{
    protected static ?string $model = WeddingTransactionModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Product and Price')->schema([
                        Grid::make('2')->schema([

                            Select::make('wedding_package_id')
                                ->relationship('weddingPackage', 'name')
                                ->preload()
                                ->searchable()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $weddingPackage = WeddingPackageModel::find($state);
                                    $price = $weddingPackage ? $weddingPackage->price : 0;

                                    $set('price', $price);

                                    $tax = 0.11;
                                    $totalTaxAmount = $tax * $price;

                                    $totalAmount = $price + $totalTaxAmount;
                                    $set('total_amount', number_format($totalAmount, 0, '', ''));
                                    $set('total_tax_amount', number_format($totalTaxAmount, 0, '', ''));
                                }),
                            TextInput::make('price')->required()->readOnly()->numeric()->prefix('IDR'),
                            TextInput::make('total_amount')->required()->readOnly()->numeric()->prefix('IDR'),
                            TextInput::make('total_tax_amount')->required()->readOnly()->numeric()->prefix('IDR'),
                            DatePicker::make('started_at')->required()
                        ])
                    ]),

                    Step::make('Customer Information')->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('phone')->required()->maxLength(255),
                        TextInput::make('email')->required()->maxLength(255),
                    ]),

                    Step::make('Payment Information')->schema([
                        TextInput::make('booking_trx_id')->required(),
                        ToggleButtons::make('is_paid')
                            ->boolean()
                            ->grouped()
                            ->icons([
                                true => 'heroicon-o-pencil',
                                false => 'heroicon-o-clock'
                            ])
                            ->required(),
                        FileUpload::make('proof')->required()->disk('public')->directory('transactions-proof')
                    ])

                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('weddingPackage.thumbnail')->disk('public'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('booking_trx_id')->searchable(),
                IconColumn::make('is_paid')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Terverifikasi')
            ])
            ->filters([
                SelectFilter::make('wedding_package_id')
                ->label('Wedding Package')
                ->relationship('weddingPackage', 'name')
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
            'index' => Pages\ListWeddingTransactions::route('/'),
            'create' => Pages\CreateWeddingTransactions::route('/create'),
            'edit' => Pages\EditWeddingTransactions::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Wedding Transactions';
    }
}
