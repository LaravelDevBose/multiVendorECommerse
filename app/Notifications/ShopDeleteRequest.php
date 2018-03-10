<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShopDeleteRequest extends Notification
{
    use Queueable;

    protected $shop;
    protected $artisan;
    protected $deteleReason;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($shop, $artisan, $deteleReason)
    {
        $this->shop = $shop;
        $this->artisan = $artisan;
        $this->deteleReason = $deteleReason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'admin'=>$notifiable,
            'shop'=>$this->shop,
            'artisan'=>$this->artisan,
            'deteleReason'=>$this->deteleReason,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
