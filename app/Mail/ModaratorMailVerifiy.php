<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModaratorMailVerifiy extends Mailable
{
    use Queueable, SerializesModels;

    public $artisan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($artisan)
    {
        $this->artisan = $artisan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@mydorpon.com')
            ->to($this->artisan->email)
            ->view('emailsTemplate.shop.modaratorMailVerfication');
    }
}
