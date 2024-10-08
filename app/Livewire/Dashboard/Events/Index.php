<?php

namespace App\Livewire\Dashboard\Events;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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

        return view('livewire.dashboard.events.index', compact('events'));
    }
}
