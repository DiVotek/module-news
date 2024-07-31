<?php

namespace Modules\News\Admin\NewsResource\Pages;

use App\Service\SeoFields;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\News\Admin\NewsResource;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
