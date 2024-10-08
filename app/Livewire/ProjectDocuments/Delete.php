<?php

namespace App\Livewire\ProjectDocuments;

use Livewire\Component;
use App\Models\Document;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public Document $document;

    public function render()
    {
        return view('livewire.project-documents.delete');
    }

    #[On('open-delete')]
    public function setDocument(Document $document)
    {
        $this->document = $document;
        $this->dispatch('open-modal', 'delete-document');
    }

    public function destroy()
    {
        Storage::delete('project-documents/' . $this->document->file);
        $this->document->delete();
        $this->dispatch('close-modal', 'delete-document');
        Session::flash('status', 'The document has been deleted');
        $this->redirect(route('project.documents', ['project' => $this->document->project_id]), true);
    }
}
