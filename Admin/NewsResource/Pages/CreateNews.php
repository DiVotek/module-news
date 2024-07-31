<?php

namespace Modules\News\Admin\NewsResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\News\Admin\NewsResource;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;
}
