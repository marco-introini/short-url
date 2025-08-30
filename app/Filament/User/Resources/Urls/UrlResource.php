<?php

namespace App\Filament\User\Resources\Urls;

use Override;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\User\Resources\Urls\Pages\CreateUrl;
use App\Filament\User\Resources\Urls\Pages\EditUrl;
use App\Filament\User\Resources\Urls\Pages\ListUrls;
use App\Filament\User\Resources\Urls\RelationManagers\UrlCallsRelationManager;
use App\Models\Url;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UrlResource extends Resource
{
    protected static ?string $model = Url::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 2;

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('original_url')->url()->required(),
            ])->columns(1);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('original_url')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('shorturl'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            UrlCallsRelationManager::class,
        ];
    }

    #[Override]
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
