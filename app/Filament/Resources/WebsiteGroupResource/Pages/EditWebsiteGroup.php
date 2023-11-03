<?php

namespace App\Filament\Resources\WebsiteGroupResource\Pages;

use App\Filament\Resources\WebsiteGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteGroup extends EditRecord
{
    protected static string $resource = WebsiteGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
