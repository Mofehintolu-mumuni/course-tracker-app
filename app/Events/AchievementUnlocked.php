<?php

namespace App\Events;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Queue\SerializesModels;
use App\Interfaces\AchievementsTypeInterface;
use Illuminate\Foundation\Events\Dispatchable;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;

    public $user;
    public $achievementName;


    /**
     * Create a new event instance.
     * @param  string  $achievementName
     * @param  User  $user
     * @return void
     */
    public function __construct(string $achievementName, User $user)
    {
        $this->achievementName = $achievementName;
        $this->user = $user;
    }
}
