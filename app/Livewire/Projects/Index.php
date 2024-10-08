<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category_id = '';

    #[Url]
    public int $per_page = 0;

    #[On('refresh-projects')]
    public function render()
    {
        $categories = Category::orderBy('name')->get();

        if (Auth::user()->role_id == 1) {
            $projects = Project::filter([
                'search' => $this->search,
                'category_id' => $this->category_id
            ])->latest()->paginate($this->per_page);
        } else {
            $projects = Project::filter([
                'search' => $this->search,
                'category_id' => $this->category_id
            ])->isMember()->latest()->paginate($this->per_page);
        }

        return view('livewire.projects.index', compact(['categories', 'projects']));
    }
}
