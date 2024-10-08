<?php

namespace App\Livewire\Users;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Document;
use App\Models\Event;
use App\Models\Expenditure;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.users.delete');
    }

    #[On('open-delete')]
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->dispatch('open-modal', 'delete-user');
    }

    public function destroy()
    {
        if ($this->user->avatar != 'avatar.png') {
            Storage::delete('users-avatar/' . $this->user->avatar);
        }

        Event::ownerId($this->user->id)->delete();
        Comment::commenterId($this->user->id)->delete();
        Discussion::createrId($this->user->id)->delete();
        Document::uploaderId($this->user->id)->delete();
        Expenditure::uploaderId($this->user->id)->delete();
        Task::workerId($this->user->id)->delete();
        Project::managerId($this->user->id)->delete();

        $this->user->delete();
        $this->dispatch('close-modal', 'delete-user');
        Session::flash('status', 'The user has been deleted');
        $this->redirect('users', true);
    }
}
