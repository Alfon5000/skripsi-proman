<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Notifications\EventCreatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'date'])]
    public $start_time;

    #[Validate(['required', 'date'])]
    public $end_time;

    #[Validate(['required', 'string'])]
    public string $description = '';

    public function render()
    {
        return view('livewire.events.create');
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['owner_id'] = Auth::id();
        $validated['color'] = '#3b82f6';
        $validated['textColor'] = '#ffffff';
        $event = Event::create($validated);
        Notification::send(Auth::user(), new EventCreatedNotification($event));
        $this->dispatch('close-modal', 'create-event');
        $this->reset();
        Session::flash('status', 'New event has been created');
        $this->redirect('events');
    }
}
