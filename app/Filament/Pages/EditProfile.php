<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class EditProfile extends BaseEditProfile
{
    /**
     * The users table has no name column, so the base page's name field is
     * dropped in favor of the email and locale fields.
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getLocaleFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }

    protected function getLocaleFormComponent(): Component
    {
        return Select::make('locale')
            ->label('Language')
            ->options([
                'en' => 'English',
                'ka' => 'ქართული',
            ])
            ->native(false)
            ->rule(Rule::in(config('app.supported_locales')));
    }
}
