<?php

namespace App\Filament\Widgets;

use App\Models\SchemeTemplatePart;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;

class TemplatesWidget extends BaseWidget
{
    public ?Model $record = null;

    protected static string $model = SchemeTemplatePart::class;

    protected static int $maxDepth = 999;

    protected ?string $treeTitle = 'TemplatesWidget';

    protected bool $enableTreeTitle = false;

    protected function getFormSchema(): array
    {
        return [
            Select::make('schemeTemplate_id')
                ->relationship('SchemeTemplate', 'name')
                ->searchable()
                ->required()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ]),
            Select::make('schemePart_id')
                ->relationship('SchemePart', 'name')
                ->searchable()
                ->required()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('code')
                        ->label('Code with __DISPLAY_TEXT__')
                        ->required(),
                ]),
            TextInput::make('condition')
                ->required()
                ->maxLength(255)
                ->type('number'),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('display_text')
                ->required()
                ->maxLength(255)
        ];
    }

    public function getRecords(): Collection|null
    {
        if ($this->records) {
            return $this->records;
        }
        $query = $this->getSortedQuery();
        if ($this->record) {
            $query->where('schemeTemplate_id', '=', $this->record->id);
        }
        return $this->records = $query->get();
    }

    public function getTreeRecordTitle(?Model $record = null): string
    {
        $runCode = str_replace('__DISPLAY_TEXT__', $record->display_text, $record->schemePart->code);
        return 'if(execute(' . $record->condition . ', \'' . $record->name . '\')) => ' . $runCode;
    }

    protected function hasDeleteAction(): bool
    {
        return true;
    }

    protected function hasEditAction(): bool
    {
        return true;
    }
}
