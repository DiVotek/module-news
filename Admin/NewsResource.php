<?php

namespace Modules\News\Admin;

use App\Filament\Resources\ProductResource\RelationManagers\SeoRelationManager;
use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\News\Models\News;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getModelLabel(): string
    {
        return __('News');
    }

    public static function getPluralModelLabel(): string
    {
        return __('News');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Schema::getReactiveName(),
                        Schema::getStatus(),
                        Schema::getSlug(),
                        Schema::getSorting(),
                        Schema::getSource(),
                        Schema::getImage(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getStatus(),
                TableSchema::getSorting(),
                TableSchema::getViews(),
                TableSchema::getUpdatedAt()
            ])
            ->reorderable('sorting')
            ->filters([
                TableSchema::getFilterStatus(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('View')
                    ->label(__('View'))
                    ->icon('heroicon-o-eye')
                    ->url(function ($record) {
                        return '/news/' . $record->slug;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationGroup::make('Seo and translates', [
                TranslatableRelationManager::class,
                SeoRelationManager::class
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\News\Admin\NewsResource\Pages\ListNews::route('/'),
            'create' => \Modules\News\Admin\NewsResource\Pages\CreateNews::route('/create'),
            'edit' => \Modules\News\Admin\NewsResource\Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
