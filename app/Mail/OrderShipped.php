<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $userInfo;
    public $orderDetils;
    public $shippingInfo;
    public $paymentInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$userInfo,$orderDetils,$shippingInfo,$paymentInfo)
    {
        $this->order = $order;
        $this->userInfo = $userInfo;
        $this->orderDetils = $orderDetils;
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
        return $this->to($this->userInfo->email)
                    ->from('no-reply@mydorpon.com')
                    ->markdown('emailsTemplate.orders.shipped');
    }
}
