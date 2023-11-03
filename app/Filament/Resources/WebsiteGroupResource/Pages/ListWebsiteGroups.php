<?php

namespace App\Filament\Resources\WebsiteGroupResource\Pages;

use App\Filament\Resources\WebsiteGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteGroups extends ListRecords
{
    protected static string $resource = WebsiteGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
