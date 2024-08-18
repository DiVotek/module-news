<?php

namespace Modules\News\Models;

use App\Models\StaticPage;
use App\Traits\HasBreadcrumbs;
use App\Traits\HasRoute;
use App\Traits\HasSlug;
use App\Traits\HasSorting;
use App\Traits\HasStatus;
use App\Traits\HasViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTable;
use App\Traits\HasTemplate;
use App\Traits\HasTimestamps;
use Modules\Seo\Traits\HasSeo;

class News extends Model
{
    use HasFactory;
    use HasBreadcrumbs;
    use HasTimestamps;
    use HasTable;
    use HasSlug;
    use HasSorting;
    use HasStatus;
    use HasViews;
    use HasSeo;
    use HasTable;
    use HasRoute;
    use HasTemplate;

    protected $fillable = [
        'name',
        'slug',
        'sorting',
        'image',
        'status',
        'views',
        'source',
        'author'
    ];

    public function getBreadcrumbs(): array
    {
        return [
            StaticPage::query()->slug(news_slug())->first()->name ?? 'News' => '/' . news_slug(),
            $this->name => $this->slug
        ];
    }

    public static function getDb(): string
    {
        return 'news';
    }
    public function route(): string
    {
        return tRoute('news-post', ['post' => $this->slug]);
    }
}
