<?php

namespace App\Filament\Resources\UrlResource\Pages;

use App\Filament\Resources\UrlResource;
use Filament\Actions\DeleteAction;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUrl extends EditRecord
{
    protected static string $resource = UrlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
