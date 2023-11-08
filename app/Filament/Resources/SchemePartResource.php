<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchemePartResource\Pages;
use App\Filament\Resources\SchemePartResource\RelationManagers;
use App\Filament\Resources\SchemeResource\RelationManagers\SchemeTemplateRelationManager;
use App\Models\SchemePart;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchemePartResource extends Resource
{
    protected static ?string $model = SchemePart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('code')
                    ->label('Code with __DISPLAY_TEXT__')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('code')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchemeParts::route('/'),
            'create' => Pages\CreateSchemePart::route('/create'),
            'edit' => Pages\EditSchemePart::route('/{record}/edit'),
        ];
    }
}
