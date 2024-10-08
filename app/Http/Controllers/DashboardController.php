<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use App\Models\Event;
use App\Models\Position;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (Auth::user()->role_id == 1) {
            $users = User::get()->count();
            $departments = Department::get()->count();
            $positions = Position::get()->count();
            $categories = Category::get()->count();

            return view('dashboard', compact(['users', 'departments', 'positions', 'categories']));
        } else {
            $projects = Project::isMember()->undone()->get()->count();
            $undones = Task::workerId(Auth::id())->undone()->get()->count();
            $events = Event::ownerId(Auth::id())->undone()->get()->count();
            $members = User::roleId(2)->get()->count();

            $todos = Task::workerId(Auth::id())->statusId(1)->get()->count();
            $progresses = Task::workerId(Auth::id())->statusId(2)->get()->count();
            $reviews = Task::workerId(Auth::id())->statusId(3)->get()->count();
            $dones = Task::workerId(Auth::id())->statusId(4)->get()->count();

            $tasksData = [
                ['Status', 'Total'],
                ['To Do', (int)$todos],
                ['In Progress', (int)$progresses],
                ['In Review', (int)$reviews],
                ['Done', (int)$dones],
            ];

            return view('dashboard', compact(['projects', 'tasksData', 'undones', 'events', 'members']));
        }
    }
}
