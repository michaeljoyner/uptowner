<?php

namespace Tests\Feature\Contact;

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     *@test
     */
    public function an_email_is_sent_when_the_contact_form_is_successfully_posted()
    {
        Mail::fake();

        $message_data = [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'phone' => '999999999',
            'enquiry' => 'TEST MESSAGE'
        ];

        $response = $this->json('POST', '/contact', $message_data);

        $response->assertStatus(200);

        Mail::assertSent(ContactMessage::class, function ($mail) use ($message_data) {
            $this->assertEquals($message_data['name'], $mail->name);
            $this->assertEquals($message_data['email'], $mail->email);
            $this->assertEquals($message_data['phone'], $mail->phone);
            $this->assertEquals($message_data['enquiry'], $mail->enquiry);
            return true;
        });


    }
}