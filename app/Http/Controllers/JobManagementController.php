<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class JobManagementController extends Controller
{
    /**
     * Get all failed jobs.
     */
    public function index()
    {
        $failedJobs = DB::table('failed_jobs')
            ->orderBy('failed_at', 'desc')
            ->get()
            ->map(function ($job) {
                $payload = json_decode($job->payload, true);
                $jobName = $payload['displayName'] ?? 'Unknown Job';
                
                // Try to get a more readable name if it's a queued closure or something
                if ($jobName === 'Illuminate\Queue\CallQueuedHandler@call' && isset($payload['data']['commandName'])) {
                    $jobName = $payload['data']['commandName'];
                }

                return [
                    'id' => $job->id,
                    'uuid' => $job->uuid,
                    'connection' => $job->connection,
                    'queue' => $job->queue,
                    'job_name' => $jobName,
                    'failed_at' => $job->failed_at,
                    'exception' => substr($job->exception, 0, 200) . '...',
                    'full_exception' => $job->exception,
                ];
            });

        return response()->json($failedJobs);
    }

    /**
     * Retry a specific failed job.
     */
    public function retry($id)
    {
        try {
            $exitCode = Artisan::call('queue:retry', ['id' => $id]);
            
            if ($exitCode === 0) {
                return response()->json(['message' => 'Job retried successfully.']);
            }

            return response()->json(['message' => 'Failed to retry job.'], 500);
        } catch (\Exception $e) {
            Log::error("Error retrying job {$id}: " . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a specific failed job.
     */
    public function delete($id)
    {
        try {
            DB::table('failed_jobs')->where('id', $id)->delete();
            return response()->json(['message' => 'Job deleted successfully.']);
        } catch (\Exception $e) {
            Log::error("Error deleting job {$id}: " . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Retry all failed jobs.
     */
    public function retryAll()
    {
        try {
            $exitCode = Artisan::call('queue:retry', ['id' => ['all']]);
            
            if ($exitCode === 0) {
                return response()->json(['message' => 'All jobs have been queued for retry.']);
            }

            return response()->json(['message' => 'Failed to retry all jobs.'], 500);
        } catch (\Exception $e) {
            Log::error("Error retrying all jobs: " . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete all failed jobs.
     */
    public function deleteAll()
    {
        try {
            DB::table('failed_jobs')->truncate();
            return response()->json(['message' => 'All failed jobs have been cleared.']);
        } catch (\Exception $e) {
            Log::error("Error clearing failed jobs: " . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
