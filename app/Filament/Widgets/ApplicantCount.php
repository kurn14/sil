<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Applicant;

class ApplicantCount extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Total Applicant'), Applicant::count())
                ->description(__('Jumlah seluruh pemohon terdaftar'))
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
