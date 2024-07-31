<?php

namespace Modules\News\Components;

use App\Models\DesignSetting;
use App\Models\Setting;
use App\Models\StaticPage;
use App\Service\MultiLang;
use App\View\Components\PageComponent;
use Illuminate\Database\Eloquent\Model;

class NewsPost extends PageComponent
{
    public function __construct(Model $entity)
    {
        $newsPage = StaticPage::query()->where('id', StaticPage::NEWS)->first();
        $breadcrumbs = [
            [
                'title' => $newsPage->name,
                'url' => tRoute('slug', ['slug' => $newsPage->slug]),
            ],
            [
                'title' => $entity->name,
                'url' => tRoute('slug', ['slug' => $newsPage->slug, 'second_slug' => $entity->slug]),
            ],
        ];
        $setting = design(DesignSetting::BLOG_CATEGORY);
        if (empty($entity->template)) {
            $entity->template = $setting->template;
        }
        $component = 'template.' . strtolower(settings(Setting::TEMPLATE)) . '.pages.news-post.' . strtolower($setting->value['type']);
        parent::__construct($entity, $component, DesignSetting::NEWS_POST, breadcrumbs: $breadcrumbs);
    }
}
