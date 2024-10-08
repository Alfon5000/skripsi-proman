<?php

namespace App\Livewire\ProjectExpenditures;

use Livewire\Component;
use App\Models\Expenditure;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Expenditure $expenditure;

    public function render()
    {
        return view('livewire.project-expenditures.delete');
    }

    #[On('open-delete')]
    public function setExpenditure(Expenditure $expenditure)
    {
        $this->expenditure = $expenditure;
        $this->dispatch('open-modal', 'delete-expenditure');
    }

    public function destroy()
    {
        $this->expenditure->delete();
        $this->dispatch('close-modal', 'delete-expenditure');
        Session::flash('status', 'The expenditure has been deleted');
        $this->redirect(route('project.expenditures', ['project' => $this->expenditure->project_id]), true);
    }
}
