<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;
    public $schedule;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cavite State University-Main Campus Schedule')->view('email.schedule');
    }
}
