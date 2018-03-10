<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $route;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$route)
    {
        $this->user = $user;
        $this->route = $route;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@mydorpon.com')
            ->to($this->user->email)
            ->view('emailsTemplate.user.userMailConfirmation');

    }
}
