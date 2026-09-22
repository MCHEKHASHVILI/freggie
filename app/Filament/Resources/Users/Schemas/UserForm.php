<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label(__('Password'))
                    ->password()
                    ->revealable()
                    ->rule(Password::defaults())
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->autocomplete('new-password'),
                Toggle::make('is_active')
                    ->label(__('Active'))
                    ->default(true)
                    ->required()
                    // Mirrors the API's self-deactivation guard (UserPolicy::updateStatus):
                    // an admin must not be able to lock themselves out from the panel.
                    ->disabled(fn (?User $record): bool => $record?->is(auth()->user()) ?? false),
                Select::make('roles')
                    ->label(__('Roles'))
                    ->relationship('roles', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Role $record): string => UserRole::tryFrom($record->name)?->getLabel() ?? $record->name)
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }
}
