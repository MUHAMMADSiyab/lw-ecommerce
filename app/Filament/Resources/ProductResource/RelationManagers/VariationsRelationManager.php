<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariationsRelationManager extends RelationManager
{
    protected static string $relationship = 'variations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('attribute_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('attribute_value')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('attribute_name')
            ->columns([
                Tables\Columns\TextColumn::make('attribute_name'),
                Tables\Columns\TextColumn::make('attribute_value'),
                Tables\Columns\TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
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
}
