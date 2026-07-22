<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Applicant;
use App\Models\FacilityUsageRequest;
use App\Models\SiteConditionReport;

class DashboardStatsOverview extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make(__('Total Applicant'), Applicant::count())
                ->description(__('Jumlah seluruh pemohon terdaftar'))
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            Stat::make(__('Total Permohonan Fasilitas'), FacilityUsageRequest::count())
                ->description(__('Jumlah seluruh pengajuan penggunaan fasilitas'))
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('success'),
            Stat::make(__('Total Laporan Kondisi'), SiteConditionReport::count())
                ->description(__('Jumlah seluruh laporan kondisi situs'))
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('warning'),
        ];
    }
}
