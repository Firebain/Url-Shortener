<?php

namespace App\Notifications;

use App\Models\ShortUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShortUrlCreated extends Notification implements ShouldQueue
{
    use Queueable;

    private $shortUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting("Привет!")
                    ->line(["Новая короткая ссылка была создана: ", $this->shortUrl->path]);
    }
}