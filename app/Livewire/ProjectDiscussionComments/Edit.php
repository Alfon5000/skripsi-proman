<?php

namespace App\Livewire\ProjectDiscussionComments;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Project;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public Project $project;

    public Discussion $discussion;

    public Comment $comment;

    #[Validate(['required', 'string'])]
    public string $body = '';

    public function render()
    {
        return view('livewire.project-discussion-comments.edit');
    }

    #[On('open-edit')]
    public function setComment(Comment $comment)
    {
        $this->comment = $comment;
        $this->discussion = Discussion::find($this->comment->discussion_id);
        $this->project = Project::find($this->discussion->project_id);
        $this->body = $comment->body;
        $this->dispatch('open-modal', 'edit-comment');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->comment->update($validated);
        $this->dispatch('close-modal', 'edit-comment');
        $this->reset('body');
        Session::flash('status', 'The comment has been updated');
        $this->redirect(route('project.discussion.comments', ['project' => $this->project, 'discussion' => $this->discussion]), true);
    }
}
