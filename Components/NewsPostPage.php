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
        $component = setting(config('settings.news.design'), 'Zero');
        $component = 'template.' . strtolower(template()) . '.pages.news-post.' . strtolower($component);
        parent::__construct($entity, $component);
    }
}
