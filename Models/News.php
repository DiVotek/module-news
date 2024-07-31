<?php

namespace Modules\News\Models;

use App\Traits\HasBreadcrumbs;
use App\Traits\HasSlug;
use App\Traits\HasSorting;
use App\Traits\HasStatus;
use App\Traits\HasViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTable;
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

    public const TABLE = 'news';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'slug',
        'sorting',
        'image',
        'status',
        'views',
        'source',
        'authors'
    ];

    protected $casts = ['authors' => 'array'];

    public function getBreadcrumbs(): array
    {
        return [
            $this->slug => $this->name
        ];
    }

    public static function getDb(): string
    {
        return 'News';
    }
}
