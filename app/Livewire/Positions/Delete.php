<?php

namespace App\Livewire\Positions;

use Livewire\Component;
use App\Models\Position;
use App\Models\User;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Position $position;

    public function render()
    {
        return view('livewire.positions.delete');
    }

    #[On('open-delete')]
    public function setPosition(Position $position)
    {
        $this->position = $position;
        $this->dispatch('open-modal', 'delete-position');
    }

    public function destroy()
    {
        User::positionId($this->position->id)->delete();
        $this->position->delete();
        $this->dispatch('close-modal', 'delete-position');
        Session::flash('status', 'The position has been deleted');
        $this->redirect('positions', true);
    }
}
