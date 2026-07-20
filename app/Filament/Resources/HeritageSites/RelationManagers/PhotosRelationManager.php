<?php

namespace App\Filament\Resources\HeritageSites\RelationManagers;

use App\Models\SitePhoto;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label(__('Photo'))
                    ->image()
                    ->directory('site-photos')
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),
                \Filament\Schemas\Components\Tabs::make('Translations')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('ID')
                            ->schema([
                                TextInput::make('caption.id')
                                    ->label(__('Caption (ID)')),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('EN')
                            ->schema([
                                TextInput::make('caption.en')
                                    ->label(__('Caption (EN)')),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label(__('Photo')),
                TextColumn::make('caption')
                    ->label(__('Caption'))
                    ->searchable(query: function (\Illuminate\Database\Eloquent\Builder $query, string $search) {
                        return $query->whereRaw("caption->>'" . app()->getLocale() . "' ilike ?", ["%{$search}%"]);
                    }),
                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                ViewAction::make()
                    ->mutateRecordDataUsing(function (array $data, \Illuminate\Database\Eloquent\Model $record): array {
                        $data['caption'] = $record->getTranslations('caption');
                        return $data;
                    }),
                EditAction::make()
                    ->mutateRecordDataUsing(function (array $data, \Illuminate\Database\Eloquent\Model $record): array {
                        $data['caption'] = $record->getTranslations('caption');
                        return $data;
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

