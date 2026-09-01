<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SampleRejected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Sample;
    public $User;
    public $Test;

    /**
     * Create a new event instance.
     */
    public function __construct($Sample, $User, $Test)
    {
        $this->Sample = $Sample;
        $this->User = $User;
        $this->Test = $Test;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.'.$this->User->id),
        ];
    }
}