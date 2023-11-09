<?php

namespace App\Filament\Resources\SchemeTemplatePartsResource\Pages;

use App\Filament\Resources\SchemeTemplatePartsResource;
use App\Filament\Widgets\TemplatesWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchemeParts extends ListRecords
{
    protected static string $resource = SchemeTemplatePartsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
