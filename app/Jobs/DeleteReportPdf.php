<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class DeleteReportPdf implements ShouldQueue
{
    use Queueable;

    public $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function handle(): void
    {
        if (Storage::disk('public')->exists($this->fileName)) {
            Storage::disk('public')->delete($this->fileName);
        }
    }
}