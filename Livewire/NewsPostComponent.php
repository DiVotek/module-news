<?php

namespace Modules\News\Livewire;

use Livewire\Component;
use Modules\News\Models\News;

class NewsPostComponent extends Component
{
    public News $news;

    public function mount(News $entity)
    {
        $this->news = $entity;
    }

    public function render()
    {
        return view('news::livewire.news-post-component');
    }
}
