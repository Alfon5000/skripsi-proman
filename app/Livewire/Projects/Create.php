<?php

namespace App\Livewire\Projects;

use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use App\Models\Category;
use App\Models\Event;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProjectCreatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Create extends Component
{
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

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.projects.create', compact(['categories']));
    }

    public function store()
    {
        $validated = $this->validate();

        if (Auth::user()->role_id != 1) {
            $validated['manager_id'] = Auth::id();
        } else {
            $validated['manager_id'] = $this->manager_id;
        }

        $project = Project::create($validated);

        if (Auth::user()->role_id != 1) {
            $project->members()->attach(Auth::id());
        } else {
            $project->members()->attach($project->manager_id);
        }

        Event::create([
            'owner_id' => $project->manager_id,
            'title' => $project->name,
            'start_time' => $project->start_time,
            'end_time' => $project->end_time,
            'description' => $project->description,
            'color' => '#ef4444',
            'textColor' => '#ffffff',
        ]);

        Notification::send(User::roleId(1)->get(), new ProjectCreatedNotification($project));
        $this->dispatch('close-modal', 'create-project');
        $this->reset();
        Session::flash('status', 'New project has been created');
        $this->redirect('projects', true);
    }
}
