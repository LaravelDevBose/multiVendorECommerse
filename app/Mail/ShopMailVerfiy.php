<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopMailVerfiy extends Mailable
{
    use Queueable, SerializesModels;

    public $artisan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($merchantile)
    {
        $this->artisan = $merchantile;
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
            ->view('emailsTemplate.shop.shopMailVerfication');
    }
}
