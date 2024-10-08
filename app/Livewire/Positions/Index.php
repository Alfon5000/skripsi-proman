<?php

namespace App\Livewire\Positions;

use App\Models\Position;
use Livewire\Component;
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
        return view('livewire.positions.index', ['positions' => Position::search($this->search)->latest()->paginate($this->per_page)]);
    }
}
