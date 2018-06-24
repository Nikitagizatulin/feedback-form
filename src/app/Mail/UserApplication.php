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
            'userId' => $this->data['userId'],
            'themeBid' => $this->data['theme'],
            'messageBid' => $this->data['message'],
            'numberOfBid'=> $this->data['lastId']
        ])->attach(storage_path('app/' . $this->data['pathFile']));
    }
}
