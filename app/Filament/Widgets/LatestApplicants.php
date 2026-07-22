<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use App\Models\Applicant;

class LatestApplicants extends TableWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = '5 Pendaftar Terakhir';

    public function table(Table $table): Table
    {
        return $table
            ->query(Applicant::query()->latest('created_at')->limit(5))
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name')),
                TextColumn::make('email')
                    ->label(__('Email')),
                TextColumn::make('phone')
                    ->label(__('Phone')),
                TextColumn::make('created_at')
                    ->label(__('Registered at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false)
            ->searchable(false);
    }
}
