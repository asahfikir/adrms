<?php

namespace App\Filament\Pages;

use App\Models\Document;
use App\Models\Criterion;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.dashboard';

    public $stats;
    public $byCriterion = [];

    public function mount(): void
    {
        $docs = Document::whereHas('subIndicator.indicator.criterion.academicYear', fn ($q) => $q->where('is_active', true));
        $total = $docs->count();
        $filled = (clone $docs)->whereNotNull('document_link')->count();

        $this->stats = [
            'total' => $total,
            'filled' => $filled,
            'percentage' => $total > 0 ? round(($filled / $total) * 100, 2) : 0,
        ];

        $criteria = Criterion::with(['indicators.subIndicators.documents'])
            ->whereHas('academicYear', fn ($q) => $q->where('is_active', true))
            ->get();

        foreach ($criteria as $c) {
            $docs = $c->indicators->flatMap(fn ($i) =>
                $i->subIndicators->flatMap(fn ($s) => $s->documents)
            );
            $total = $docs->count();
            $filled = $docs->filter(fn ($d) => $d->document_link !== null)->count();

            $this->byCriterion[] = [
                'name' => $c->name,
                'percentage' => $total > 0 ? round(($filled / $total) * 100, 2) : 0,
            ];
        }
    }
}
