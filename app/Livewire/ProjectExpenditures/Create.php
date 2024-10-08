<?php

namespace App\Livewire\ProjectExpenditures;

use App\Models\Project;
use Livewire\Component;
use App\Models\Expenditure;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ExpenditureAddedNotification;

class Create extends Component
{
    use WithFileUploads;

    public Project $project;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'date'])]
    public $date;

    #[Validate(['required', 'numeric'])]
    public int $amount = 0;

    #[Validate(['required', 'string'])]
    public string $description = '';

    #[Validate(['required', 'file', 'max:5120'])]
    public $evidence;

    public function render()
    {
        return view('livewire.project-expenditures.create');
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }

    public function store()
    {
        $validated = $this->validate();
        $this->evidence->storeAs('project-expenditures', $this->evidence->hashName());
        $validated['evidence'] = $this->evidence->hashName();
        $validated['project_id'] = $this->project->id;
        $validated['uploader_id'] = Auth::id();
        $expenditure = Expenditure::create($validated);
        Notification::send($this->project->members()->get(), new ExpenditureAddedNotification($expenditure));
        $this->dispatch('close-modal', 'add-expenditure');
        $this->resetExcept('project');
        Session::flash('status', 'New expenditure has been added');
        $this->redirect(route('project.expenditures', ['project' => $this->project]), true);
    }
}
