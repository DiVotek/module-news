<?php

namespace Modules\News\Admin\NewsResource\Widgets;

use App\Services\TableSchema;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;
use Modules\News\Models\News;

class TopNews extends BaseWidget
{
    protected static ?int $sort = 7;

    protected function getTableHeading(): string|Htmlable|null
    {
        return __('Top news');
    }

    public function table(Table $table): Table
    {
        $currentModel = News::class;

        return $table
            ->searchable(false)
            ->query(function () use ($currentModel) {
                return $currentModel::query()->orderBy('views', 'desc')->take(5);
            })
            ->columns([
                TableSchema::getName(),
                TableSchema::getViews(),
            ])->actions([
                Action::make('View')
                    ->label(__('View'))
                    ->icon('heroicon-o-eye')
                    ->url(function ($record) {
                        return route('slug', ['slug' => $record->slug]);
                    }),
            ])
            ->paginated(false)->defaultPaginationPageOption(5);
    }
}
