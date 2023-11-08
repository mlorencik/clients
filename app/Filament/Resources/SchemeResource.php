<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchemeResource\Pages;
use App\Models\SchemeTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchemeResource extends Resource
{
    protected static ?string $model = SchemeTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Show code'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchemes::route('/'),
            'create' => Pages\CreateScheme::route('/create'),
            'edit' => Pages\EditScheme::route('/{record}/edit'),
            'view' => Pages\ViewScheme::route('/{record}')
        ];
    }
}
