<?php

namespace App\Filament\Resources\SitePhotos;

use App\Filament\Resources\SitePhotos\Pages\CreateSitePhoto;
use App\Filament\Resources\SitePhotos\Pages\EditSitePhoto;
use App\Filament\Resources\SitePhotos\Pages\ListSitePhotos;
use App\Filament\Resources\SitePhotos\Pages\ViewSitePhoto;
use App\Filament\Resources\SitePhotos\Schemas\SitePhotoForm;
use App\Filament\Resources\SitePhotos\Schemas\SitePhotoInfolist;
use App\Filament\Resources\SitePhotos\Tables\SitePhotosTable;
use App\Models\SitePhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SitePhotoResource extends Resource
{
    protected static ?string $model = SitePhoto::class;

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string | \UnitEnum | null $navigationGroup = 'Situs Cagar Budaya';

    public static function form(Schema $schema): Schema
    {
        return SitePhotoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SitePhotoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SitePhotosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSitePhotos::route('/'),
            'create' => CreateSitePhoto::route('/create'),
            'view' => ViewSitePhoto::route('/{record}'),
            'edit' => EditSitePhoto::route('/{record}/edit'),
        ];
    }
}
