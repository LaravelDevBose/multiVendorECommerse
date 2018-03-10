<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserQusen extends Mailable
{
    use Queueable, SerializesModels;

    public $answer;
    public $qusenInfo;
    public $productInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($answer, $qusenInfo, $productInfo)
    {
        $this->answer = $answer;
        $this->qusenInfo = $qusenInfo;
        $this->productInfo = $productInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@mydorpon.com')
                    ->markdown('emailsTemplate.question.userQuesn');
    }
}
