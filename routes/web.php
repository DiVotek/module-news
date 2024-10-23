<?php

use App\Models\StaticPage;
use App\Models\SystemPage;
use App\Services\MultiLang;
use Illuminate\Support\Facades\Route;
use Modules\News\Controllers\NewsController;

if (!function_exists('news_slug')) {
   function news_slug()
   {
      $page = StaticPage::query()->where('id', SystemPage::query()->where('name', 'News')->first()->page_id ?? 0)->first();
      return $page && $page->slug ? $page->slug : 'news';
   }
}
Route::get(news_slug() . '/{post}', [NewsController::class, 'post'])->name('news-post');
if (is_multi_lang()) {
   foreach (MultiLang::getActiveLanguages() as $language) {
      Route::get($language->slug . '/' . news_slug() . '/{post}', [NewsController::class, 'post'])->name($language->slug . '.news-post');
   }
}
