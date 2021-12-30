<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use App\Interfaces\AchievementsTypeInterface;
use Illuminate\Foundation\Events\Dispatchable;

class BadgeUnlocked
{
    use Dispatchable, SerializesModels;

    public $user;
    public $badgeName;


    /**
     * Create a new event instance.
     * @param  string  $badgeName
     * @param  User  $user
     * @return void
     */
    public function __construct(string $badgeName, User $user)
    {
        $this->badgeName = $badgeName;
        $this->user = $user;
    }
}
