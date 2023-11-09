<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchemeTemplatePartsResource\Pages;
use App\Filament\Resources\SchemeTemplatePartsResource\RelationManagers\SchemeTemplateRelationManager;
use App\Models\SchemeTemplate;
use App\Models\SchemeTemplatePart;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SchemeTemplatePartsResource extends Resource
{
    protected static ?string $model = SchemeTemplatePart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->type('number')
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('display_text')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('schemeTemplate.name')->searchable('name'),
                TextColumn::make('schemePart.name')->searchable('name'),
                TextColumn::make('condition')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('display_text')->searchable(),
            ])
            ->filters([
                SelectFilter::make('schemeTemplate_id')
                    ->relationship('SchemeTemplate', 'name')
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchemeParts::route('/'),
            'create' => Pages\CreateSchemeParts::route('/create'),
            'edit' => Pages\EditSchemeParts::route('/{record}/edit'),
        ];
    }
}
