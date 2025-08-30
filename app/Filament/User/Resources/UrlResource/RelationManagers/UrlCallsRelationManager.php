<?php

namespace App\Filament\User\Resources\UrlResource\RelationManagers;

use Override;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class UrlCallsRelationManager extends RelationManager
{
    protected static string $relationship = 'url_calls';

    protected static ?string $recordTitleAttribute = 'created_at';

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('created_at')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at'),
                TextColumn::make('ip_address')->label('IP Address'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}
