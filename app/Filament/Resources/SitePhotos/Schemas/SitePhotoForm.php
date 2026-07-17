<?php

namespace App\Filament\Resources\SitePhotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SitePhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('heritage_site_id')
                    ->relationship('site', 'name')
                    ->required(),
                FileUpload::make('file_path')
                    ->image()
                    ->directory('site-photos')
                    ->required(),
                TextInput::make('caption'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_featured')
                    ->default(false),
            ]);
    }
}
