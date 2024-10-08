<?php

namespace App\Livewire\Positions;

use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public Position $position;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    public function render()
    {
        return view('livewire.positions.edit');
    }

    #[On('open-edit')]
    public function setPosition(Position $position)
    {
        $this->position = $position;
        $this->name = $position->name;
        $this->dispatch('open-modal', 'edit-position');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->position->update($validated);
        $this->reset();
        $this->dispatch('close-modal', 'edit-position');
        Session::flash('status', 'The position has been updated');
        $this->redirect('positions', true);
    }
}
