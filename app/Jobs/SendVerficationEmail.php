<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendVerficationEmail implements ShouldQueue
{
    use Queueable;

    public $userId;
    public $code;

    public function __construct($userId, $code)
    {
        $this->userId = $userId;
        $this->code = $code;
    }

    public function handle(): void
    {
        $user = User::find($this->userId);

        if (!$user) {
            logger()->error("Queue: User not found", [
                'user_id' => $this->userId
            ]);
            return;
        }

        Mail::to($user->email)
            ->send(new VerificationEmail($user, $this->code));
    }
}
