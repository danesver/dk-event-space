<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitReminder extends Mailable
{
    public $wedding;

    public function __construct($wedding)
    {
        $this->wedding = $wedding;
    }

    public function build()
    {
        return $this->view('emails.visit_reminder')  // Assuming you have a view for the email
            ->subject('Visit Reminder')
            ->with([
                'eventDate' => $this->wedding->event_date,
                'visit_date_time' => $this->wedding->visit_date. ' '.$this->wedding->visit_time,
                'status' => $this->wedding->status,
                'name' => $this->wedding->firstname.' '. $this->wedding->lastname,
                'type' => $this->wedding->wedding_type,
                // Add any other data you want to include in the email
            ]);
    }
}
