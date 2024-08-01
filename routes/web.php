<?php

use App\Models\StaticPage;
use App\Models\SystemPage;
use Illuminate\Support\Facades\Route;
use Modules\News\Controllers\NewsController;

function news_slug()
{
   $page = StaticPage::query()->where('id', SystemPage::query()->where('name', 'News')->first()->page_id ?? 0)->first();
   return $page && $page->slug ? $page->slug : 'news';
}
Route::get(news_slug() . '/{post}', [NewsController::class, 'post'])->name('news-post');
