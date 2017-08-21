<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;


    public $name;
    public $email;
    public $phone;
    public $enquiry;

    public function __construct($message_data)
    {
        $this->name = $message_data['name'] ?? 'Not supplied';
        $this->email = $message_data['email'] ?? 'Not supplied';
        $this->phone = $message_data['phone'] ?? 'Not supplied';
        $this->enquiry = $message_data['enquiry'] ?? 'Not supplied';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Uptowner site message from ' . $this->name)->markdown('email.contact');
    }
}
