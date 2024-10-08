<?php

namespace App\Livewire\ProjectDiscussionComments;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Discussion;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Project $project;
    public Discussion $discussion;
    public bool $toggle = false;

    #[Url]
    public string $search = '';

    #[Url]
    public int $per_page = 0;

    // #[On('refresh-comments')]
    public function render()
    {
        $comments = Comment::discussionId($this->discussion->id)->filter($this->search)->oldest()->paginate($this->per_page);

        return view('livewire.project-discussion-comments.index', compact('comments'));
    }

    public function mount(string $projectId, string $discussionId)
    {
        $this->project = Project::find($projectId);
        $this->discussion = Discussion::find($discussionId);
    }

    public function toggleComment()
    {
        $this->toggle = !$this->toggle;
    }

    #[On('close-comment')]
    public function closeComment()
    {
        $this->toggle = false;
    }
}
