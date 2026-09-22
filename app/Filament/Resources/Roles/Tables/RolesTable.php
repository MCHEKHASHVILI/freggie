<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Enums\UserPermission;
use App\Enums\UserRole;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->formatStateUsing(fn (string $state): string => UserRole::tryFrom($state)?->getLabel() ?? $state)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('permissions.name')
                    ->label(__('Permissions'))
                    ->formatStateUsing(fn (string $state): string => UserPermission::tryFrom($state)?->getLabel() ?? $state)
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
                // The panel is only reachable by the superadmin role itself; deleting
                // it would permanently lock every superadmin out of the panel.
                DeleteAction::make()
                    ->visible(fn (Role $record): bool => $record->name !== UserRole::Superadmin->value),
            ]);
    }
}
