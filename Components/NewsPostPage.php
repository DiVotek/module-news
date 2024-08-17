<?php

namespace Modules\News\Components;

use App\Models\DesignSetting;
use App\Models\Setting;
use App\Models\StaticPage;
use App\Service\MultiLang;
use App\View\Components\PageComponent;
use Illuminate\Database\Eloquent\Model;

class NewsPostPage extends PageComponent
{
    public function __construct(Model $entity)
    {
        if (empty($entity->template)) {
            $entity->template = setting(config('settings.news.template'), []);
        }
        parent::__construct($entity, 'news::news-post-component');
    }
}
