<?php

namespace App\Filament\Resources\SubIndicatorResource\Pages;

use App\Filament\Resources\SubIndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubIndicators extends ListRecords
{
    protected static string $resource = SubIndicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
