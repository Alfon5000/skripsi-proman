<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public Event $event;

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
        return view('livewire.events.edit');
    }

    #[On('open-edit')]
    public function setEvent(Event $event)
    {
        $this->dispatch('close-modal', 'event-menu');
        $this->event = $event;
        $this->title = $event->title;
        $this->start_time = $event->start_time->toDateTimeString();
        $this->end_time = $event->end_time->toDateTimeString();
        $this->description = $event->description;
        $this->dispatch('open-modal', 'edit-event');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->event->update($validated);
        $this->dispatch('close-modal', 'edit-event');
        $this->reset();
        Session::flash('status', 'The event has been updated');
        $this->redirect('events');
    }
}
