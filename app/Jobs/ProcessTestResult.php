<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Result;
use Illuminate\Support\Facades\Storage;

class ProcessTestResult implements ShouldQueue
{
    use Queueable;

    public $orderId;
    public $orderTestId;

    public function __construct($orderId, $orderTestId)
    {
        $this->orderId = $orderId;
        $this->orderTestId = $orderTestId;
    }

    public function handle(): void
    {
        $order = Order::with([
            'tests' => function ($query) {
                $query->wherePivot('id', $this->orderTestId);
            }
        ])->where('id', $this->orderId)->first();

        if (!$order) {
            return;
        }

        $test = $order->tests->first();

        if (!$test || $test->pivot->status !== 'Completed') {
            return;
        }

        $results = Result::where('orderTestId', $test->pivot->id)
            ->with('parameter')
            ->get();

        $pdf = Pdf::loadView(
            'TestReport',
            compact('order', 'test', 'results')
        );

        $fileName = "reports/Report-{$order->trackingId}-{$test->name}.pdf";

        Storage::disk('public')->put(
            $fileName,
            $pdf->output()
        );
    }
}