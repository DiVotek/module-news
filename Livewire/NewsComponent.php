<?php

namespace Modules\News\Livewire;

use App\Models\StaticPage;
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
        return view('news::livewire.news-component', [
            'news' => News::query()->paginate(1)
        ]);
    }
}
