<?php

namespace App\Livewire\Notifications;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public int $per_page = 0;

    #[On('refresh-notifications')]
    public function render()
    {
        $notifications = Auth::user()->notifications()->when($this->search ?? false, function ($query) {
            $query->where('data->message', 'like', "%$this->search%");
        })->paginate($this->per_page);
        $unreadNotifications = Auth::user()->unreadNotifications()->get();

        return view('livewire.notifications.index', compact(['notifications', 'unreadNotifications']));
    }
}
