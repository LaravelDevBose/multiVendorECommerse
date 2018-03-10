<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $logo;
    public $order;
    public $userInfo;
    public $shippingInfo;
    public $paymentInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($logo,$order,$userInfo,$shippingInfo,$paymentInfo)
    {
        $this->logo = $logo;
        $this->order = $order;
        $this->userInfo = $userInfo;
        $this->shippingInfo = $shippingInfo;
        $this->paymentInfo = $paymentInfo;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@mydorpon.com')
            ->to($this->userInfo->email)
            ->view('emailsTemplate.orders.invoice');
    }
}
