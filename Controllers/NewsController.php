<?php

namespace Modules\News\Controllers;

use Illuminate\Support\Facades\Blade;
use Modules\News\Components\NewsPostPage;
use Modules\News\Models\News;

class NewsController
{
   public function post(string $post)
   {
      $news = News::query()->where('slug', $post)->first();
      if (!$news) {
         abort(404);
      }
      return Blade::renderComponent(new NewsPostPage($news));
   }
}
