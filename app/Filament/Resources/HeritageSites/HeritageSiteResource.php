<?php

namespace App\Filament\Resources\HeritageSites;

use App\Filament\Resources\HeritageSites\Pages\CreateHeritageSite;
use App\Filament\Resources\HeritageSites\Pages\EditHeritageSite;
use App\Filament\Resources\HeritageSites\Pages\ListHeritageSites;
use App\Filament\Resources\HeritageSites\Pages\ViewHeritageSite;
use App\Filament\Resources\HeritageSites\Schemas\HeritageSiteForm;
use App\Filament\Resources\HeritageSites\Schemas\HeritageSiteInfolist;
use App\Filament\Resources\HeritageSites\Tables\HeritageSitesTable;
use App\Models\HeritageSite;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class HeritageSiteResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeritageSite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    public static function getNavigationGroup(): ?string
    {
        return __('Heritage sites');
    }

    public static function getModelLabel(): string
    {
        return __('Heritage site');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Heritage sites');
    }

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return HeritageSiteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HeritageSiteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HeritageSitesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHeritageSites::route('/'),
            'create' => CreateHeritageSite::route('/create'),
            'view' => ViewHeritageSite::route('/{record}'),
            'edit' => EditHeritageSite::route('/{record}/edit'),
        ];
    }
}
