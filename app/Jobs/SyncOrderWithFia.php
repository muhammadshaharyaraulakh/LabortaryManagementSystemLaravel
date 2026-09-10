<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncOrderWithFia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Http::fake([
                'api.fia.gov.pk/*' => Http::response([
                    'status' => 'success',
                    'receipt_number' => 'FIA-TEST-' . uniqid() . rand(100000, 999999)
                ], 200)
            ]);

            $response = Http::timeout(10)->post('https://api.fia.gov.pk/tax/sync', [
                'tracking_id' => $this->order->trackingId,
                'tax_amount' => $this->order->tax,
                'total_amount' => $this->order->grandTotal,
                'lab_id' => env('FIA_LAB_KEY', 'TEST_KEY_123')
            ]);

            if ($response->successful()) {
                $this->order->update([
                    'fiaReceiptNo' => $response->json('receipt_number')
                ]);
                Log::info("Order {$this->order->trackingId} synced with FIA. Receipt: " . $response->json('receipt_number'));
            } else {
                Log::error("FIA Sync failed for Order {$this->order->trackingId}: " . $response->body());
                throw new \Exception("FIA Sync failed: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Error in SyncOrderWithFia for Order {$this->order->trackingId}: " . $e->getMessage());
            throw $e;
        }
    }
}
