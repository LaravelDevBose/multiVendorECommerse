<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $shopFounder;
    public $shopName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status,$shopFounder,$shopName)
    {
        $this->status = $status;
        $this->shopFounder = $shopFounder;
        $this->shopName = $shopName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->shopFounder->email)
                    ->from('no-reply@mydorpon.com')
                    ->markdown('emailsTemplate.admin.shopStatusMail');
    }
}
