<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ProjectsStatus extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    public string $category_id = '';

    public int $per_page = 0;

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        if (Auth::user()->role_id == 1) {
            $projects = Project::filter(['search' => $this->search, 'category_id' => $this->category_id])->paginate($this->per_page);
        } else {
            $projects = Project::filter(['search' => $this->search, 'category_id' => $this->category_id])->isMember()->paginate($this->per_page);
        }

        return view('livewire.dashboard.projects-status', compact(['categories', 'projects']));
    }
}
