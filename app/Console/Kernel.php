<?php

namespace App\Console;

use App\Models\Event;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\EventReminderNotification;
use App\Notifications\ProjectReminderNotification;
use App\Notifications\TaskReminderNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            foreach (Project::get() as $project) {
                if ($project->end_time->diffInDays(absolute: false) == -1) {
                    Notification::send($project->members()->get(), new ProjectReminderNotification($project));
                }
            }

            foreach (Task::get() as $task) {
                if ($task->end_time->diffInDays(absolute: false) == -1) {
                    Notification::send(User::find($task->worker_id), new TaskReminderNotification($task));
                }
            }

            foreach (Event::get() as $event) {
                if ($event->end_time->diffInDays(absolute: false) == -1) {
                    Notification::send(User::find($event->owner_id), new EventReminderNotification($event));
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
