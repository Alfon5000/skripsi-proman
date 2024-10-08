<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->role_id == 1;
        });

        Gate::define('user', function (User $user) {
            return $user->role_id == 2;
        });

        Gate::define('manager', function (User $user, Project $project) {
            return $user->id == $project->manager_id;
        });

        Gate::define('admin-manager', function (User $user, Project $project) {
            return $user->role_id == 1 || $user->id == $project->manager_id;
        });

        Gate::define('worker', function (User $user, Task $task) {
            return $user->id == $task->worker_id;
        });

        Gate::define('manager-worker', function (User $user, Task $task) {
            return $user->id == $task->project->manager_id || $user->id == $task->worker_id;
        });

        Gate::define('admin-manager-worker', function (User $user, Task $task) {
            return $user->role_id == 1 || $user->id == $task->project->manager_id || $user->id == $task->worker_id;
        });

        Gate::define('admin-creater', function (User $user, Discussion $discussion) {
            return $user->role_id == 1 || $user->id == $discussion->creater_id;
        });

        Gate::define('commenter', function (User $user, Comment $comment) {
            return $user->role_id == $comment->commenter_id;
        });

        Gate::define('admin-manager-uploader', function (User $user, $model) {
            return $user->role_id == 1 || $user->id == $model->project->manager_id || $user->id == $model->uploader_id;
        });
    }
}
