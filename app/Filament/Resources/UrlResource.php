<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UrlResource\Pages;
use App\Filament\Resources\UrlResource\RelationManagers;
use App\Models\Url;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UrlResource extends Resource
{
    protected static ?string $model = Url::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return Url::where('user_id', '=', auth()->user()->id);
    }

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
            RelationManagers\UrlCallsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUrls::route('/'),
            'create' => Pages\CreateUrl::route('/create'),
            'edit' => Pages\EditUrl::route('/{record}/edit'),
        ];
    }

    public function view(User $user, Url $url): bool
    {
        return ($url->user_id == $user->id);
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::getModel()::where('user_id','=',auth()->user()->id)->count();
    }

}
