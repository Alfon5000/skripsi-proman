<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.events.show');
    }

    #[On('open-details')]
    public function setEvent(Event $event)
    {
        $this->dispatch('close-modal', 'event-menu');
        $this->event = $event;
        $this->dispatch('open-modal', 'event-details');
    }
}
