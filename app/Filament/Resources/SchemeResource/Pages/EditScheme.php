<?php

namespace App\Filament\Resources\SchemeResource\Pages;

use App\Filament\Resources\SchemeResource;
use App\Filament\Widgets\TemplatesWidget;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheme extends EditRecord
{
    protected static string $resource = SchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('Show code'),
            Actions\DeleteAction::make(),
        ];
    }

}
