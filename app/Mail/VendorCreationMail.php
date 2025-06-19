<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorCreationMail extends Mailable {
    use Queueable, SerializesModels;

    /**
    * Create a new message instance.
    */

    public $vendorname;
    public $email;
    public $password;

    public function __construct( $vendorname, $email, $password ) {
        $this->vendorname = $vendorname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
    * Get the message envelope.
    */

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Vendor Creation Mail',
        );
    }

    /**
    * Get the message content definition.
    */

    public function content(): Content {
        return new Content(
            view: 'email.vendorcreation',
            with: [
                'vendorname' => $this->vendorname,
                'email' => $this->email,
                'password' => $this->password,
            ],
        );
    }

    /**
    * Get the attachments for the message.
    *
    * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    */

    public function attachments(): array {
        return [];
    }
}