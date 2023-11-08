<?php

namespace App\Filament\Resources\SchemeTemplatePartsResource\Pages;

use App\Filament\Resources\SchemeTemplatePartsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchemeParts extends EditRecord
{
    protected static string $resource = SchemeTemplatePartsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
