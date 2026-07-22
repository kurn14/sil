<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\FacilityUsageRequest;
use Carbon\Carbon;

class FacilityUsageChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Grafik Permohonan Fasilitas';

    protected function getData(): array
    {
        $data = FacilityUsageRequest::query()
            ->orderBy('created_at')
            ->get()
            ->groupBy(fn ($request) => $request->created_at->format('M Y'))
            ->map(fn ($group) => $group->count());

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Permohonan',
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
