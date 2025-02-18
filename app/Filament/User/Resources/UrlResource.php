<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\UrlResource\Pages\CreateUrl;
use App\Filament\User\Resources\UrlResource\Pages\EditUrl;
use App\Filament\User\Resources\UrlResource\Pages\ListUrls;
use App\Filament\User\Resources\UrlResource\RelationManagers\UrlCallsRelationManager;
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

    #[\Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('original_url')->url()->required(),
            ])->columns(1);
    }

    #[\Override]
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

    #[\Override]
    public static function getRelations(): array
    {
        return [
            UrlCallsRelationManager::class,
        ];
    }

    #[\Override]
    public static function getPages(): array
    {
        return [
            'index' => ListUrls::route('/'),
            'create' => CreateUrl::route('/create'),
            'edit' => EditUrl::route('/{record}/edit'),
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
