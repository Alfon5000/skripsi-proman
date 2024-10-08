<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DiscussionCommentedNotification extends Notification
{
    use Queueable;

    public Discussion $discussion;
    public Comment $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Discussion $discussion, Comment $comment)
    {
        $this->discussion = $discussion;
        $this->comment = $comment;
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
            'message' => "User: {$this->comment->commenter->name} comments in discussion: {$this->discussion->title}",
            'url' => route('project.discussion.comments', ['project' => $this->discussion->project_id, 'discussion' => $this->discussion->id]),
        ];
    }
}
