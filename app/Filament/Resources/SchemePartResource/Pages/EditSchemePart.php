<?php

namespace App\Filament\Resources\SchemePartResource\Pages;

use App\Filament\Resources\SchemePartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchemePart extends EditRecord
{
    protected static string $resource = SchemePartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
