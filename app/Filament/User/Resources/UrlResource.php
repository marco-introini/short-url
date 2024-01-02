<?php

namespace App\Filament\User\Resources;

use App\Filament\Resources\UrlResource\Pages;
use App\Filament\Resources\UrlResource\RelationManagers;
use App\Filament\User\Resources;
use App\Models\Url;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UrlResource extends Resource
{
    protected static ?string $model = Url::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('original_url')->url()->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('original_url')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('shorturl'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            Resources\UrlResource\RelationManagers\UrlCallsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Resources\UrlResource\Pages\ListUrls::route('/'),
            'create' => Resources\UrlResource\Pages\CreateUrl::route('/create'),
            'edit' => Resources\UrlResource\Pages\EditUrl::route('/{record}/edit'),
        ];
    }

    public function view(User $user, Url $url): bool
    {
        return ($url->user_id == $user->id);
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::where('user_id','=',auth()->user()->id)->count();
    }

}
