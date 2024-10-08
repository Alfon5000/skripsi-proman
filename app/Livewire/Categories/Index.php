<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public int $per_page = 0;

    public function render()
    {
        return view('livewire.categories.index', ['categories' => Category::search($this->search)->latest()->paginate($this->per_page)]);
    }
}
