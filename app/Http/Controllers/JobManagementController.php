<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Carbon\Carbon;
class JobManagementController extends Controller
{

    public function index()
    {
        $failedJobs = FailedJob::orderBy('failed_at', 'desc')
            ->get()
            ->map(function ($job) {
                $payload = json_decode($job->payload, true);
                $jobName = $payload['displayName'] ?? 'Unknown Job';
                
                $jobName = class_basename($jobName);
                
                $exceptionMsg = $job->exception;
                if (preg_match('/^[\w\\\]+: (.*)$/m', $exceptionMsg, $matches)) {
                    $exceptionMsg = $matches[1];
                }
                $exceptionMsg = explode("\n", $exceptionMsg)[0];

                if (str_contains($exceptionMsg, 'Connection could not be established')) {
                    $exceptionMsg = 'Connection failed';
                }

                return [
                    'id' => $job->id,
                    'uuid' => $job->uuid,
                    'connection' => $job->connection,
                    'queue' => $job->queue,
                    'job_name' => $jobName,
                    'failed_at' => Carbon::parse($job->failed_at)->format('Y-m-d'),
                    'exception' => substr($exceptionMsg, 0, 100),
                    'full_exception' => $job->exception,
                ];
            });

        return response()->json([
            'status' => true,
            'message' => 'Failed jobs retrieved successfully.',
            'data' => $failedJobs
        ], Response::HTTP_OK);
    }


    public function retry($id)
    {
        try {
            $exitCode = Artisan::call('queue:retry', ['id' => $id]);
            
            if ($exitCode === 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'Job retried successfully.'
                ], Response::HTTP_OK);
            }

            return response()->json([
                'status' => false,
                'message' => 'Failed to retry job.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("Error retrying job {$id}: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function delete($id)
    {
        try {
            $job = FailedJob::findOrFail($id);
            $job->delete();
            return response()->json([
                'status' => true,
                'message' => 'Job deleted successfully.'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Error deleting job {$id}: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function retryAll()
    {
        try {
            $exitCode = Artisan::call('queue:retry', ['id' => ['all']]);
            
            if ($exitCode === 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'All jobs have been queued for retry.'
                ], Response::HTTP_OK);
            }

            return response()->json([
                'status' => false,
                'message' => 'Failed to retry all jobs.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("Error retrying all jobs: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function deleteAll()
    {
        try {
            FailedJob::truncate();
            return response()->json([
                'status' => true,
                'message' => 'All failed jobs have been cleared.'
            ], Response::HTTP_OK);
        } 
        catch (\Exception $e) {
            Log::error("Error clearing failed jobs: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
