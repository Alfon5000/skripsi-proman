<?php

namespace App\Livewire\Projects;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Document;
use App\Models\Event;
use App\Models\Expenditure;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Project $project;

    public Project $oldProject;

    public function render()
    {
        return view('livewire.projects.delete');
    }

    #[On('open-delete')]
    public function setProject(Project $project)
    {
        $this->project = $project;
        $this->oldProject = $project;
        $this->dispatch('open-modal', 'delete-project');
    }

    public function destroy()
    {
        $this->project->delete();

        $discussions = Discussion::projectId($this->oldProject->id)->get();

        foreach ($discussions as $discussion) {
            Comment::discussionId($discussion->id)->delete();
        }

        ProjectMember::where('project_id', $this->oldProject->id)->delete();
        Task::projectId($this->oldProject->id)->delete();
        Discussion::projectId($this->oldProject->id)->delete();
        Document::projectId($this->oldProject->id)->delete();
        Expenditure::projectId($this->oldProject->id)->delete();

        $events = Event::where('title', $this->oldProject->name)->where('start_time', $this->oldProject->start_time)->where('end_time', $this->oldProject->end_time)->where('description', $this->oldProject->description)->get();

        foreach ($events as $event) {
            $event->delete();
        }

        $this->dispatch('close-modal', 'delete-project');
        Session::flash('status', 'The project has been deleted');
        $this->redirect('projects', true);
    }
}
