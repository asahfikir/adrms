<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubIndicatorResource\Pages;
use App\Filament\Resources\SubIndicatorResource\RelationManagers;
use App\Models\SubIndicator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Indicator;

class SubIndicatorResource extends Resource
{
    protected static ?string $model = SubIndicator::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('indicator_id')
                    ->label('Indikator')
                    ->options(Indicator::query()
                        ->whereHas('criterion', fn($query) => $query->whereHas('academicYear', fn($query) => $query->where('is_active', true)))
                        ->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Textarea::make('name')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('indicator.name')->label('Indikator'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSubIndicators::route('/'),
            'create' => Pages\CreateSubIndicator::route('/create'),
            'edit' => Pages\EditSubIndicator::route('/{record}/edit'),
        ];
    }
}
