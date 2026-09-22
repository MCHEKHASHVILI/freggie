<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class EditProfile extends BaseEditProfile
{
    /**
     * The users table has no name column, and email/language changes don't
     * belong here (email is admin-managed; language has its own topbar
     * switcher), so this page is just the profile fields and password.
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getProfileGroupComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }

    protected function getProfileGroupComponent(): Component
    {
        return Group::make()
            ->relationship('profile')
            ->schema([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->columnSpanFull(),
                TextInput::make('surname')
                    ->label(__('Surname'))
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label(__('Phone'))
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label(__('Avatar'))
                    ->collection('avatar')
                    ->avatar()
                    ->circleCropper()
                    ->columnSpanFull(),
            ]);
    }

    /**
     * The base component's visibility also shows this field when the email
     * has changed; this page has no email field, so that half of the check
     * is dropped.
     */
    protected function getCurrentPasswordFormComponent(): Component
    {
        return parent::getCurrentPasswordFormComponent()
            ->visible(fn (Get $get): bool => filled($get('password')));
    }

    /**
     * The base page's handleRecordUpdate() calls $record->update($data)
     * directly rather than going through a Resource page's save flow, so the
     * relationship-bound profile Group (dehydrated: false, saved via its
     * own hook) needs to be persisted explicitly here.
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $this->form->saveRelationships();

        return parent::handleRecordUpdate($record, $data);
    }
}
