<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResultEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $patientName;
    public $orderTrackingId;
    public $testName;
    public $testPdf;

    public function __construct($patientName, $orderTrackingId, $testName, $testPdf)
    {
        $this->patientName = $patientName;
        $this->orderTrackingId = $orderTrackingId;
        $this->testName = $testName;
        $this->testPdf = $testPdf;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Result - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.result',
        );
    }

    public function attachments(): array
    {
        if (!file_exists($this->testPdf)) {
            return [];
        }

        return [
            Attachment::fromPath($this->testPdf)
                ->as($this->patientName . '-' . $this->testName . '.pdf')
        ];
    }
}
