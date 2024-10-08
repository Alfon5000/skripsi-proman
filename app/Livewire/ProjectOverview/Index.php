<?php

namespace App\Livewire\ProjectOverview;

use App\Models\Expenditure;
use App\Models\Task;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public Project $project;

    public function render()
    {
        $weightDoneTasks = DB::table('tasks AS t')->join('priorities AS p', 't.priority_id', '=', 'p.id')->select('p.weight')->where('project_id', $this->project->id)->where('t.status_id', 4)->sum('p.weight');
        $weightAllTasks = DB::table('tasks AS t')->join('priorities AS p', 't.priority_id', '=', 'p.id')->select('p.weight')->where('project_id', $this->project->id)->sum('p.weight');

        if ($weightAllTasks > 0) {
            $progress = round($weightDoneTasks / $weightAllTasks * 100, 0) . '%';
        } else {
            $progress = "0%";
        }

        $todos = Task::projectId($this->project->id)->statusId(1)->get()->count();
        $progresses = Task::projectId($this->project->id)->statusId(2)->get()->count();
        $reviews = Task::projectId($this->project->id)->statusId(3)->get()->count();
        $dones = Task::projectId($this->project->id)->statusId(4)->get()->count();

        if ($todos > 0 || $progresses > 0 || $reviews > 0 || $dones > 0) {
            $tasksData = [
                ['Status', 'Total'],
                ['To Do', (int)$todos],
                ['In Progress', (int)$progresses],
                ['In Review', (int)$reviews],
                ['Done', (int)$dones],
            ];
        } else {
            $tasksData = [
                ['Status', 'Total'],
                ['To Do', 0],
                ['In Progress', 0],
                ['In Review', 0],
                ['Done', 0],
            ];
        }

        $expenditures = Expenditure::projectId($this->project->id)->orderBy('date')->get();

        $expendituresData = [['Date', 'Amount']];

        if ($expenditures->count()) {
            foreach ($expenditures as $expenditure) {
                $expendituresData[] = [$expenditure->date->format('d-m-Y'), $expenditure->amount];
            }
        } else {
            $expendituresData[] = [Carbon::now()->format('d-m-Y'), 0];
        }

        return view('livewire.project-overview.index', [
            'progress' => $progress,
            'members' => $this->project->members()->get()->count(),
            'documents' => $this->project->documents()->get()->count(),
            'discussions' => $this->project->discussions()->get()->count(),
            'expenditures' => $this->project->expenditures()->get()->sum('amount'),
            'tasksData' => $tasksData,
            'expendituresData' => $expendituresData,
        ]);
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
