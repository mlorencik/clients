<?php

namespace App\Filament\Resources\SchemeResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchemeTemplatePartRelationManager extends RelationManager
{
    protected static string $relationship = 'schemeTemplatePart';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('schemePart.name')->searchable('name'),
                TextColumn::make('condition')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('display_text')->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
