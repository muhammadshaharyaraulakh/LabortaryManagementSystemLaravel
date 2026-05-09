<?php

namespace App\Http\Controllers;

use App\Jobs\SendPromotionalEmailJob;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminPromotionalEmailController extends Controller
{
    /**
     * Send promotional emails to all customers in a batch.
     */
    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $subject = $request->subject;
        $content = $request->content;

        // Get unique emails from orders table
        $emails = Order::whereNotNull('email')
            ->distinct()
            ->pluck('email');

        if ($emails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No customer emails found in the records.'
            ], 404);
        }

        $jobs = [];
        foreach ($emails as $email) {
            $jobs[] = new SendPromotionalEmailJob($email, $subject, $content);
        }

        $batch = Bus::batch($jobs)
            ->name('Promotional Email Batch: ' . $subject)
            ->dispatch();

        return response()->json([
            'status' => true,
            'message' => 'Promotional email batch has been dispatched.',
            'batchId' => $batch->id,
            'totalJobs' => count($jobs)
        ]);
    }

    /**
     * Get the status of a specific batch.
     */
    public function batchStatus($batchId)
    {
        $batch = Bus::findBatch($batchId);

        if (!$batch) {
            return response()->json(['status' => false, 'message' => 'Batch not found.'], 404);
        }

        return response()->json([
            'id' => $batch->id,
            'name' => $batch->name,
            'totalJobs' => $batch->totalJobs,
            'pendingJobs' => $batch->pendingJobs,
            'failedJobs' => $batch->failedJobs,
            'processedJobs' => $batch->processedJobs(),
            'progress' => $batch->progress(),
            'finished' => $batch->finished(),
            'cancelled' => $batch->cancelled(),
        ]);
    }
}
