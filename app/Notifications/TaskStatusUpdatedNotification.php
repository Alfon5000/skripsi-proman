<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusUpdatedNotification extends Notification
{
    use Queueable;

    public Task $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if ($this->task->status_id == 1) {
            $status = 'to do';
        } else if ($this->task->status_id == 2) {
            $status = 'in progress';
        } else if ($this->task->status_id == 3) {
            $status = 'in review';
        } else {
            $status = 'done';
        }

        return [
            'message' => "The task: {$this->task->title} status updated to {$status}",
            'url' => route('project.tasks', $this->task->project_id) . "?search={$this->task->title}",
        ];
    }
}
