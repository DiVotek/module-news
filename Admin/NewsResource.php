<?php

namespace Modules\News\Admin;

use App\Filament\Resources\StaticPageResource\RelationManagers\TemplateRelationManager;
use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use App\Models\Setting;
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
use Modules\Seo\Admin\SeoResource\Pages\SeoRelationManager;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    public static function getNavigationGroup(): ?string
    {
        return __('Info pages');
    }

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
                    })->openUrlInNewTab(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Template')
                    ->slideOver()
                    ->icon('heroicon-o-cog')
                    ->fillForm(function (): array {
                        return [
                            'template' => setting(config('settings.news.template'),[]),
                            'design' => setting(config('settings.news.design'),'Zero')
                        ];
                    })
                    ->action(function (array $data): void {
                        setting([
                            config('settings.news.template') => $data['template'],
                            config('settings.news.design') => $data['design']
                        ]);
                        Setting::updatedSettings();
                    })
                    ->form(function ($form) {
                        return $form
                            ->schema([
                                Section::make('')->schema([
                                    Schema::getModuleTemplateSelect('Pages/NewsPost'),
                                    Schema::getTemplateBuilder()->label(__('Template')),
                                ]),
                            ]);
                    })
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
                SeoRelationManager::class,
                TemplateRelationManager::class,
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
