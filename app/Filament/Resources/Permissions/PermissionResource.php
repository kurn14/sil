<?php

namespace App\Filament\Resources\Permissions;

use App\Filament\Resources\Permissions\Pages;
use App\Filament\Resources\Permissions\RelationManagers;
use App\Models\Permission;
use App\Enums\PermissionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-key';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Pengguna';
    }

    public static function getModelLabel(): string
    {
        return 'Permission';
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('name')
                    ->label(__('Nama Permission'))
                    ->options(collect(PermissionType::cases())->mapWithKeys(fn ($enum) => [$enum->value => $enum->label()]))
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Hidden::make('guard_name')
                    ->default(config('auth.defaults.guard', 'web')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Nama Permission'))
                    ->formatStateUsing(fn (string $state): string => PermissionType::tryFrom($state)?->label() ?? $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label(__('Guard'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
