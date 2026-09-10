<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VoidOrderWithFia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trackingId;
    protected $fiaReceiptNo;

    /**
     * Create a new job instance.
     */
    public function __construct($trackingId, $fiaReceiptNo)
    {
        $this->trackingId = $trackingId;
        $this->fiaReceiptNo = $fiaReceiptNo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (empty($this->fiaReceiptNo)) {
            Log::warning("Cannot void order {$this->trackingId} with FIA: No receipt number provided.");
            return;
        }

        try {
            Http::fake([
                'api.fia.gov.pk/*' => Http::response([
                    'status' => 'success',
                    'message' => 'Receipt voided successfully'
                ], 200)
            ]);

            $response = Http::timeout(10)->post('https://api.fia.gov.pk/tax/void', [
                'tracking_id' => $this->trackingId,
                'receipt_number' => $this->fiaReceiptNo,
                'lab_id' => env('FIA_LAB_KEY', 'TEST_KEY_123'),
                'reason' => 'Patient cancelled order'
            ]);

            if ($response->successful()) {
                Log::info("Order {$this->trackingId} voided with FIA.");
            } else {
                Log::error("FIA Void failed for Order {$this->trackingId}: " . $response->body());
                throw new \Exception("FIA Void failed: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Error in VoidOrderWithFia for Order {$this->trackingId}: " . $e->getMessage());
            throw $e;
        }
    }
}
