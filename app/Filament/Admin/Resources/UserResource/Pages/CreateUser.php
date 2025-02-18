<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    #[\Override]
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
