<?php

namespace App\Livewire\Events;

use App\Models\Task;
use App\Models\Event;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;

class Menu extends Component
{
    public Event $event;

    public bool $show;

    public function render()
    {
        return view('livewire.events.menu');
    }

    #[On('set-event')]
    public function setEvent($eventId)
    {
        $this->event = Event::find($eventId);

        if ($this->event->color == '#3b82f6') {
            $this->show = true;
        } else {
            $this->show = false;
        }

        $this->dispatch('open-modal', 'event-menu');
    }
}
