<?php

namespace App\Filament\Pages;

use App\Models\Subcategory;
use Filament\Pages\Page;
use App\Models\AcademicYear;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;


class StakeholderDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static string $view = 'filament.pages.stakeholder-dashboard';
    protected static ?string $navigationGroup = 'Monitoring';
    protected static ?string $title = 'Dokumen Dashboard';

    public function getViewData(): array
    {
        $activeYear = AcademicYear::where('is_active', true)->first();
        $categories = Category::where('academic_year_id', $activeYear->id)->get();

        return [
            'categories' => $categories,
            // 'users' => User::all(),
            'users' => User::role('user')->get(),
            'subcategories' => Subcategory::with(['category', 'user'])
                ->whereHas('category', fn($q) => $q->where('academic_year_id', $activeYear->id))
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'document_url' => $item->document_url,
                    'category_id' => $item->category_id,
                    'category_name' => $item->category->name,
                    'user_id' => $item->user->id,
                    'user_name' => optional($item->user)->name,
                ]),
        ];
    }

}
