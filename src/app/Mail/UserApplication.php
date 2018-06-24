<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserApplication extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($arrData)
    {
        $this->data = $arrData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.shipped')
            ->with([
            'userId' => $this->data[2],
            'themeBid' => $this->data[0]->theme,
            'messageBid' => $this->data[0]->message,
            'numberOfBid'=> $this->data[3]
        ])->attach(storage_path('app/' . $this->data[1]));
    }
}
