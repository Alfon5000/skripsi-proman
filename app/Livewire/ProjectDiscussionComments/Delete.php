<?php

namespace App\Livewire\ProjectDiscussionComments;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Project;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\On;

class Delete extends Component
{
    public Project $project;

    public Discussion $discussion;

    public Comment $comment;

    public function render()
    {
        return view('livewire.project-discussion-comments.delete');
    }

    #[On('open-delete')]
    public function setComment(Comment $comment)
    {
        $this->comment = $comment;
        $this->discussion = Discussion::find($this->comment->discussion_id);
        $this->project = Project::find($this->discussion->project_id);
        $this->dispatch('open-modal', 'delete-comment');
    }

    public function destroy()
    {
        $this->comment->delete();
        $this->dispatch('close-modal', 'delete-comment');
        Session::flash('status', 'The comment has been deleted');
        $this->redirect(route('project.discussion.comments', ['project' => $this->project, 'discussion' => $this->discussion]), true);
    }
}
