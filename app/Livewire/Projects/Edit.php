<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use App\Models\Category;
use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public Project $project;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate('required', message: 'The category field is required.')]
    public string $category_id = '';

    // #[Validate('required', message: 'The manager field is required.')]
    public string $manager_id = '';

    #[Validate(['required', 'date'])]
    public $start_time;

    #[Validate(['required', 'date'])]
    public $end_time;

    #[Validate(['required', 'numeric'])]
    public int $budget = 0;

    #[Validate(['required', 'string'])]
    public string $description = '';

    public Project $oldProject;

    public function render()
    {
        return view('livewire.projects.edit', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    #[On('open-edit')]
    public function setProject(Project $project)
    {
        $this->project = $project;
        $this->oldProject = $project;
        $this->name = $project->name;
        $this->category_id = $project->category_id;
        $this->manager_id = $project->manager_id;
        $this->start_time = $project->start_time->format('Y-m-d H:i');
        $this->end_time = $project->end_time->format('Y-m-d H:i');
        $this->budget = $project->budget;
        $this->description = $project->description;
        $this->dispatch('open-modal', 'edit-project');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->project->update($validated);

        $events = Event::where('title', $this->oldProject->name)->where('start_time', $this->oldProject->start_time)->where('end_time', $this->oldProject->end_time)->where('description', $this->oldProject->description)->get();

        foreach ($events as $event) {
            $event->update([
                'title' => $this->project->name,
                'start_time' => $this->project->start_time,
                'end_time' => $this->project->end_time,
                'description' => $this->project->description,
            ]);
        }

        $this->dispatch('close-modal', 'edit-project');
        $this->reset();
        Session::flash('status', 'The project has been updated');
        $this->redirect('projects', true);
    }
}
