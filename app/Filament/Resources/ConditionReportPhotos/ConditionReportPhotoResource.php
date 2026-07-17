<?php

namespace App\Filament\Resources\ConditionReportPhotos;

use App\Filament\Resources\ConditionReportPhotos\Pages\CreateConditionReportPhoto;
use App\Filament\Resources\ConditionReportPhotos\Pages\EditConditionReportPhoto;
use App\Filament\Resources\ConditionReportPhotos\Pages\ListConditionReportPhotos;
use App\Filament\Resources\ConditionReportPhotos\Pages\ViewConditionReportPhoto;
use App\Filament\Resources\ConditionReportPhotos\Schemas\ConditionReportPhotoForm;
use App\Filament\Resources\ConditionReportPhotos\Schemas\ConditionReportPhotoInfolist;
use App\Filament\Resources\ConditionReportPhotos\Tables\ConditionReportPhotosTable;
use App\Models\ConditionReportPhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConditionReportPhotoResource extends Resource
{
    protected static ?string $model = ConditionReportPhoto::class;

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCamera;

    protected static string | \UnitEnum | null $navigationGroup = 'Situs Cagar Budaya';

    public static function form(Schema $schema): Schema
    {
        return ConditionReportPhotoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConditionReportPhotoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConditionReportPhotosTable::configure($table);
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
            'index' => ListConditionReportPhotos::route('/'),
            'create' => CreateConditionReportPhoto::route('/create'),
            'view' => ViewConditionReportPhoto::route('/{record}'),
            'edit' => EditConditionReportPhoto::route('/{record}/edit'),
        ];
    }
}
