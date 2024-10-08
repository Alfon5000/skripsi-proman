<?php

namespace App\Livewire\ProjectDocuments;

use Livewire\Component;
use App\Models\Document;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Document $document;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['max:2048'])]
    public $file;

    public $old_file;

    public function render()
    {
        return view('livewire.project-documents.edit');
    }

    #[On('open-edit')]
    public function setDocument(Document $document)
    {
        $this->document = $document;
        $this->title = $document->title;
        $this->file = $document->file;
        $this->old_file = $document->file;
        $this->dispatch('open-modal', 'edit-document');
    }

    public function update()
    {
        $validated = $this->validate();

        if (gettype($this->file) == 'object') {
            $this->file->storeAs('project-documents', $this->file->hashName());
            $validated['file'] = $this->file->hashName();
            Storage::delete('project-documents/' . $this->old_file);
        }

        $this->document->update($validated);
        $this->dispatch('close-modal', 'edit-document');
        $this->resetExcept('document');
        Session::flash('status', 'The document has been updated');
        $this->redirect(route('project.documents', ['project' => $this->document->project_id]), true);
    }
}
