<?php

namespace Modules\News\Livewire;

use App\Models\StaticPage;
use App\Models\SystemPage;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\News\Models\News;

class NewsComponent extends Component
{
    use WithPagination;

    public $url;
    public StaticPage $page;

    public function mount(StaticPage $entity)
    {
        $this->url = url()->current();
        $this->page = $entity;
    }

    public function render()
    {
        $page = SystemPage::query()->where('page_id', $this->page->id)->first();
        $design = 'news.default';
        if($page && $page->design) {
            $design = $page->design;
        }
        return view('template::' . $design, [
            'news' => News::query()->paginate(1)
        ]);
    }
}
