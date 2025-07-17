<?php

namespace App\Filament\Resources\SubIndicatorResource\Pages;

use App\Filament\Resources\SubIndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubIndicator extends EditRecord
{
    protected static string $resource = SubIndicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
