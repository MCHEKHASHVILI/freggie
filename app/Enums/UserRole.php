<?php

namespace App\Enums;

enum UserRole: string
{
    case Superadmin = 'superadmin';
    case Admin = 'admin';
    case Director = 'director';
    case Manager = 'manager';
    case Courier = 'courier';
}
