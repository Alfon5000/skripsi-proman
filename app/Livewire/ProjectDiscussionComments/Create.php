<?php

namespace App\Livewire\ProjectDiscussionComments;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Discussion;
use App\Models\Project;
use App\Notifications\DiscussionCommentedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;

class Create extends Component
{
    public Project $project;
    public Discussion $discussion;

    #[Validate(['required', 'string'])]
    public string $body = '';

    public function render()
    {
        return view('livewire.project-discussion-comments.create');
    }

    public function mount(string $projectId, string $discussionId)
    {
        $this->project = Project::find($projectId);
        $this->discussion = Discussion::find($discussionId);
    }

    public function store()
    {
        $valdated = $this->validate();
        $valdated['discussion_id'] = $this->discussion->id;
        $valdated['commenter_id'] = auth()->id();
        $comment = Comment::create($valdated);
        Notification::send($this->project->members()->get(), new DiscussionCommentedNotification($this->discussion, $comment));
        $this->dispatch('close-modal', 'create-comment');
        $this->reset('body');
        Session::flash('status', 'New comment has been added');
        $this->redirect(route('project.discussion.comments', ['project' => $this->project, 'discussion' => $this->discussion]), true);
    }
}
