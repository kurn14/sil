<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Applicant;
use App\Models\FacilityUsageRequest;
use App\Models\SiteConditionReport;

class DashboardStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
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
                ->color('success')
                ->url(\App\Filament\Pages\FacilityUsageRequestOverview::getUrl()),
            Stat::make(__('Total Laporan Kondisi'), SiteConditionReport::count())
                ->description(__('Jumlah seluruh laporan kondisi situs'))
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('warning')
                ->url(\App\Filament\Pages\SiteConditionReportOverview::getUrl())
        ];
    }
}
