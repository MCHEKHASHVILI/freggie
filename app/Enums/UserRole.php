<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Superadmin = 'superadmin';
    case Admin = 'admin';
    case Director = 'director';
    case Manager = 'manager';
    case Courier = 'courier';

    public function getLabel(): string
    {
        return match ($this) {
            self::Superadmin => __('Super Admin'),
            self::Admin => __('Admin'),
            self::Director => __('Director'),
            self::Manager => __('Manager'),
            self::Courier => __('Courier'),
        };
    }
}
