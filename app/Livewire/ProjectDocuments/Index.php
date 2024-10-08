<?php

namespace App\Livewire\ProjectDocuments;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
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

    #[On('refresh-documents')]
    public function render()
    {
        $documents = Document::projectId($this->project->id)->filter($this->search)->latest()->paginate($this->per_page);

        return view('livewire.project-documents.index', compact(['documents']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }

    public function download(string $file)
    {
        $path = Storage::path('project-documents/' . $file);
        return response()->download($path);
    }
}
