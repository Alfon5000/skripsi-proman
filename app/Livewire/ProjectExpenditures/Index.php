<?php

namespace App\Livewire\ProjectExpenditures;

use App\Models\Project;
use Livewire\Component;
use App\Models\Expenditure;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Project $project;

    #[Url]
    public string $search = '';

    #[Url]
    public int $per_page = 0;

    #[On('refresh-expenditures')]
    public function render()
    {
        $expenditures = Expenditure::projectId($this->project->id)->filter($this->search)->latest()->paginate($this->per_page);
        $totalExpenditures = Expenditure::projectId($this->project->id)->sum('amount');

        return view('livewire.project-expenditures.index', compact(['expenditures', 'totalExpenditures']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
