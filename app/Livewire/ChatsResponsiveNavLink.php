<?php

namespace App\Livewire;

use App\Models\ChMessage;
use Livewire\Component;

class ChatsResponsiveNavLink extends Component
{
    public function render()
    {
        return view('livewire.chats-responsive-nav-link', [
            'unseenChats' => ChMessage::toAuth()->unseen()->get(),
        ]);
    }
}
