<?php

namespace App\Notifications;

use App\Models\Department;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepartmentCreatedNotification extends Notification
{
    use Queueable;

    public Department $department;

    /**
     * Create a new notification instance.
     */
    public function __construct(Department $department)
    {
        $this->department = $department;
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
        return [
            'message' => "New department: {$this->department->name} created",
            'url' => route('departments') . "?search={$this->department->name}",
        ];
    }
}
