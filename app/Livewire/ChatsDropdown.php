<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ChatsDropdown extends Component
{
    #[On('refresh-chats-dropdown')]
    public function render()
    {
        return view('livewire.chats-dropdown', [
            'chats' => ChMessage::toAuth()->unseen()->latest()->get(),
        ]);
    }

    public function seeAll()
    {
        ChMessage::toAuth()->update(['seen' => 1]);
        $this->dispatch('refresh-chats-dropdown');
    }

    public function seeOne($id)
    {
        $unseenChat = ChMessage::find($id);
        $unseenChat->update(['seen' => 1]);
        $this->dispatch('refresh-chats-dropdown');
    }
}
