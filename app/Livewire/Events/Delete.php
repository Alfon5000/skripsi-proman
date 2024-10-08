<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.events.delete');
    }

    #[On('open-delete')]
    public function setEvent(Event $event)
    {
        $this->dispatch('close-modal', 'event-menu');
        $this->event = $event;
        $this->dispatch('open-modal', 'delete-event');
    }

    public function destroy()
    {
        $this->event->delete();
        $this->dispatch('close-modal', 'delete-event');
        Session::flash('status', 'The event has been deleted');
        $this->redirect('events');
    }
}
