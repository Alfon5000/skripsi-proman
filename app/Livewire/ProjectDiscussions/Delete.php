<?php

namespace App\Livewire\ProjectDiscussions;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Discussion;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Discussion $discussion;

    public function render()
    {
        return view('livewire.project-discussions.delete');
    }

    #[On('open-delete')]
    public function setDiscussion(Discussion $discussion)
    {
        $this->discussion = $discussion;
        $this->dispatch('open-modal', 'delete-discussion');
    }

    public function destroy()
    {
        Comment::discussionId($this->discussion->id)->delete();
        $this->discussion->delete();
        $this->dispatch('close-modal', 'delete-discussion');
        Session::flash('status', 'The discussion has been deleted');
        $this->redirect(route('project.discussions', ['project' => $this->discussion->project_id]), true);
    }
}
