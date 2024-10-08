<?php

namespace App\Livewire\Positions;

use App\Models\User;
use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PositionCreatedNotification;
use Illuminate\Support\Facades\Session;

class Create extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    public function render()
    {
        return view('livewire.positions.create');
    }

    public function store()
    {
        $validated = $this->validate();
        $position = Position::create($validated);
        Notification::send(User::roleId(1)->get(), new PositionCreatedNotification($position));
        $this->dispatch('close-modal', 'create-position');
        $this->reset();
        Session::flash('status', 'New position has been created');
        $this->redirect('positions', true);
    }
}
