<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // The panel is only reachable by the superadmin role itself;
            // deleting it would permanently lock every superadmin out.
            DeleteAction::make()
                ->visible(fn (): bool => $this->getRecord()->name !== UserRole::Superadmin->value),
        ];
    }
}
