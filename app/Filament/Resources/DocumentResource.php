<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Criterion;
use App\Models\Indicator;
use App\Models\SubIndicator;
use App\Models\AcademicYear;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('criterion_id')
                    ->label('Kriteria')
                    ->options(Criterion::query()
                        ->whereHas('academicYear', fn($query) => $query->where('is_active', true))
                        ->pluck('name', 'id'))
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('indicator_id', null)),
                Forms\Components\Select::make('indicator_id')
                    ->label('Indikator')
                    ->options(function (callable $get) {
                        $criterionId = $get('criterion_id');
                        if (!$criterionId) return [];
                        return Indicator::where('criterion_id', $criterionId)->pluck('name', 'id');
                    })
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('sub_indicator_id', null)),
                Forms\Components\Select::make('sub_indicator_id')
                    ->label('Sub Indikator')
                    ->options(function (callable $get) {
                        $indicatorId = $get('indicator_id');
                        if (!$indicatorId) return [];
                        return SubIndicator::where('indicator_id', $indicatorId)->pluck('name', 'id');
                    })
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('PIC')
                    ->relationship('user', 'name')
                    ->searchable(),
                Forms\Components\Textarea::make('target')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('table_data'),
                Forms\Components\TextInput::make('document_name')
                    ->required(),
                Forms\Components\Textarea::make('document_link')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subIndicator.name')->label('Sub Indikator'),
                Tables\Columns\TextColumn::make('subIndicator.indicator.name')->label('Indikator'),
                Tables\Columns\TextColumn::make('subIndicator.indicator.criterion.name')->label('Kriteria'),
                Tables\Columns\TextColumn::make('user.name')->label('PIC'),
                Tables\Columns\TextColumn::make('document_link')
                    ->label('Link')
                    ->url(fn ($record) => $record->document_link ?? null)
                    ->openUrlInNewTab()
                    ->default('-'),
                Tables\Columns\TextColumn::make('document_name')
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
