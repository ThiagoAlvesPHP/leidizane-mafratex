<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpResource\Pages;
use App\Models\Op;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OpResource extends Resource
{
    protected static ?string $model = Op::class;

    protected static ?string $slug = 'ops';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Select::make('product_id')
                            ->label('Produto')
                            ->preload()
                            ->searchable()
                            ->relationship('product', 'name'),

                        DatePicker::make('date_op')
                            ->label('Data')
                            ->required(),

                        TextInput::make('number_op')
                            ->label('N° OP')
                            ->required(),
                    ]),

                TimePicker::make('preiod_start_init')
                    ->label('Inicio às')
                    ->required(),

                TimePicker::make('period_start_end')
                    ->required()
                    ->label('Finalizou às'),

                TimePicker::make('period_stop_init')
                    ->label('Tempo parado inicio'),

                TimePicker::make('period_stop_end')
                    ->label('Tempo parado fim'),

                TextInput::make('quantity')
                    ->columnSpanFull()
                    ->label('Total')
                    ->required()
                    ->numeric(),

                Grid::make(6)
                    ->schema([
                        TextInput::make('quantity_primary')
                            ->label('Quantidade de 1ª')
                            ->numeric(),

                        TextInput::make('quantity_secondy')
                            ->label('Quantidade de 2ª')
                            ->numeric(),

                        TextInput::make('quantity_third')
                            ->label('Quantidade de 3ª')
                            ->numeric(),

                        TextInput::make('quantity_longitudinal')
                            ->label('Quantidade Longitudinal')
                            ->numeric(),

                        TextInput::make('quantity_transversal')
                            ->label('Quantidade Transversal')
                            ->numeric(),

                        TextInput::make('quantity_court')
                            ->label('Quantidade de Corte')
                            ->numeric(),
                    ]),

                RichEditor::make('observations')
                    ->label('Observações')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->badge()
                    ->label('Produto'),

                TextColumn::make('number_op')
                    ->badge()
                    ->label('N° OP')
                    ->searchable(),

                TextColumn::make('date_op')
                    ->badge()
                    ->label('Data'),

                TextColumn::make('preiod_start_init')
                    ->label('Inicio às')
                    ->time(),

                TextColumn::make('period_start_end')
                    ->label('Finalizou às')
                    ->time(),

                TextColumn::make('period_stop_init')
                    ->label('Tempo parado inicio')
                    ->time(),

                TextColumn::make('period_stop_end')
                    ->label('Tempo parado fim')
                    ->time(),

                TextColumn::make('quantity')
                    ->label('Quantidade Total'),

                TextColumn::make('quantity_primary')
                    ->label('Quantidade de 1ª'),

                TextColumn::make('quantity_secondy')
                    ->label('Quantidade de 2ª'),

                TextColumn::make('quantity_third')
                    ->label('Quantidade de 3ª'),

                TextColumn::make('quantity_longitudinal')
                    ->label('Quantidade Longitudinal'),

                TextColumn::make('quantity_transversal')
                    ->label('Quantidade Transversal'),

                TextColumn::make('quantity_court')
                    ->label('Quantidade de Corte'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOps::route('/'),
            'create' => Pages\CreateOp::route('/create'),
            'edit' => Pages\EditOp::route('/{record}/edit'),
            'report' => Pages\ReportOp::route('/report'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
