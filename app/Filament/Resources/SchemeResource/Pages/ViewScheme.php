<?php

namespace App\Filament\Resources\SchemeResource\Pages;

use App\Filament\Resources\SchemeResource;
use App\Filament\Widgets\TemplatesWidget;
use App\Models\SchemeTemplate;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewScheme extends ViewRecord
{
    protected static string $resource = SchemeResource::class;

    protected static string $view = 'filament.resources.scheme.pages.view-code';

    public function getTitle(): string|Htmlable
    {
        return 'Code view for ' . $this->getRecord()->name;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('code')
                    ->rows(20)
                    ->autosize()
            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $parts = SchemeTemplate::find($data['id'])->schemeTemplatePart;

        $data['code'] = SchemeTemplate::makeTree($parts, -1, 0);

        return $data;
    }

    protected function getFooterWidgets(): array
    {
        return [
            TemplatesWidget::class
        ];
    }
}
