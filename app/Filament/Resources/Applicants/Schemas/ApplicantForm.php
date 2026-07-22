<?php

namespace App\Filament\Resources\Applicants\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ApplicantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('nik'),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('institution_name'),
            ]);
    }
}
