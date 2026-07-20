<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages;
use App\Filament\Resources\Roles\RelationManagers;
use Spatie\Permission\Models\Role;
use App\Enums\PermissionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-shield-check';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Pengguna';
    }

    public static function getModelLabel(): string
    {
        return 'Role';
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label(__('Nama Role'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Hidden::make('guard_name')
                    ->default(config('auth.defaults.guard', 'web')),
                Forms\Components\CheckboxList::make('permissions')
                    ->label(__('Hak Akses (Permissions)'))
                    ->relationship('permissions', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => PermissionType::tryFrom($record->name)?->label() ?? $record->name)
                    ->columns(2)
                    ->gridDirection('row')
                    ->bulkToggleable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Nama Role'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('permissions.name')
                    ->label(__('Permissions'))
                    ->formatStateUsing(fn (string $state): string => PermissionType::tryFrom($state)?->label() ?? $state)
                    ->badge()
                    ->separator(',')
                    ->limitList(3)
                    ->expandableLimitedList(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label(__('Guard'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
