<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SiteConditionReport;

class SiteConditionReportChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Grafik Laporan Kondisi Situs';
    protected string $color = 'warning';

    protected function getData(): array
    {
        $data = SiteConditionReport::query()
            ->orderBy('created_at')
            ->get()
            ->groupBy(fn ($report) => $report->created_at->format('M Y'))
            ->map(fn ($group) => $group->count());

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => $data->values()->toArray(),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
