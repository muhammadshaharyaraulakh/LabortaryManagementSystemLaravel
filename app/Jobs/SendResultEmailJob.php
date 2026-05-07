<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResultEmail;

class SendResultEmailJob implements ShouldQueue
{
    use Queueable;

    public $email;
    public $patientName;
    public $trackingId;
    public $testName;
    public $pdfPath;

    public function __construct(
        $email,
        $patientName,
        $trackingId,
        $testName,
        $pdfPath
    ) {
        $this->email = $email;
        $this->patientName = $patientName;
        $this->trackingId = $trackingId;
        $this->testName = $testName;
        $this->pdfPath = $pdfPath;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(
            new ResultEmail(
                $this->patientName,
                $this->trackingId,
                $this->testName,
                $this->pdfPath
            )
        );
    }
}