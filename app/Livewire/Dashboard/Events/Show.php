<?php

namespace App\Livewire\Dashboard\Events;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.dashboard.events.show');
    }

    #[On('set-event')]
    public function setEvent($eventId)
    {
        $this->event = Event::find($eventId);
        $this->dispatch('open-modal', 'show-event');
    }
}
