<?php

namespace Modules\News\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\News\Models\News;

class NewsComponent extends Component
{
    use WithPagination;

    public $url;

    public function mount()
    {
        $this->url = url()->current();
    }

    public function render()
    {
        return view('news::livewire.news-component', [
            'news' => News::query()->paginate(10)
        ]);
    }
}
