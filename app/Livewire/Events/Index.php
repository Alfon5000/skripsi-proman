<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $events = Event::ownerId(Auth::id())->get();

        foreach ($events as $event) {
            $events[] = [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start' => $event->start_time,
                'end' => $event->end_time,
                'color' => $event->color,
                'textColor' => $event->textColor,
            ];
        }

        return view('livewire.events.index', compact('events'));
    }
}
