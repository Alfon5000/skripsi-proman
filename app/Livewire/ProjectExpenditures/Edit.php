<?php

namespace App\Livewire\ProjectExpenditures;

use Livewire\Component;
use App\Models\Expenditure;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Expenditure $expenditure;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'date'])]
    public $date;

    #[Validate(['required', 'numeric'])]
    public int $amount;

    #[Validate(['required', 'string'])]
    public string $description = '';

    #[Validate(['max:5120'])]
    public $evidence;

    public $old_evidence;

    public function render()
    {
        return view('livewire.project-expenditures.edit');
    }

    #[On('open-edit')]
    public function setExpenditure(Expenditure $expenditure)
    {
        $this->expenditure = $expenditure;
        $this->title = $expenditure->title;
        $this->date = $expenditure->date->toDateString();
        $this->amount = $expenditure->amount;
        $this->description = $expenditure->description;
        $this->evidence = $expenditure->evidence;
        $this->old_evidence = $expenditure->old_evidence;
        $this->dispatch('open-modal', 'edit-expenditure');
    }

    public function update()
    {
        $validated = $this->validate();

        if (gettype($this->evidence) == 'object') {
            $this->evidence->storeAs('project-documents', $this->evidence->hashName());
            $validated['evidence'] = $this->evidence->hashName();
            Storage::delete('project-documents/' . $this->old_evidence);
        }

        $this->expenditure->update($validated);
        $this->dispatch('close-modal', 'edit-expenditure');
        $this->resetExcept('expenditure');
        Session::flash('status', 'The expenditure has been updated');
        $this->redirect(route('project.expenditures', ['project' => $this->expenditure->project_id]), true);
    }
}
