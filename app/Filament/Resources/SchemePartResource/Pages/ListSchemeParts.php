<?php

namespace App\Filament\Resources\SchemePartResource\Pages;

use App\Filament\Resources\SchemePartResource;
use App\Filament\Widgets\TemplatesWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchemeParts extends ListRecords
{
    protected static string $resource = SchemePartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
