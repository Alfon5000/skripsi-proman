<?php

namespace App\Livewire\ProjectExpenditures;

use Livewire\Component;
use App\Models\Expenditure;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Show extends Component
{
    public Expenditure $expenditure;

    public function render()
    {
        return view('livewire.project-expenditures.show');
    }

    #[On('open-details')]
    public function setExpenditure(Expenditure $expenditure)
    {
        $this->expenditure = $expenditure;
        $this->dispatch('open-modal', 'expenditure-details');
    }

    public function download(string $file)
    {
        $path = Storage::path('project-expenditures/' . $file);
        return response()->download($path);
    }
}
