<?php

namespace App\Livewire\ProjectDocuments;

use App\Models\Project;
use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DocumentAddedNotification;

class Create extends Component
{
    use WithFileUploads;

    public Project $project;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'file', 'max:2048'])]
    public $file;

    public function render()
    {
        return view('livewire.project-documents.create');
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }

    public function store()
    {
        $validated = $this->validate();
        $this->file->storeAs('project-documents', $this->file->hashName());
        $validated['file'] = $this->file->hashName();
        $validated['project_id'] = $this->project->id;
        $validated['uploader_id'] = Auth::id();
        $document = Document::create($validated);
        Notification::send($this->project->members()->get(), new DocumentAddedNotification($document));
        $this->dispatch('close-modal', 'add-document');
        $this->resetExcept('project');
        Session::flash('status', 'New document has been added');
        $this->redirect(route('project.documents', ['project' => $this->project]), true);
    }
}
