<?php

namespace App\Filament\User\Resources\UrlResource\Pages;

use Override;
use App\Filament\User\Resources\UrlResource;
use App\Helpers\Shortener;
use Filament\Resources\Pages\CreateRecord;

class CreateUrl extends CreateRecord
{
    protected static string $resource = UrlResource::class;

    #[Override]
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['short_url_string'] = Shortener::shorten($data['original_url']);
        $data['user_id'] = auth()->id();

        return $data;
    }

    #[Override]
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
