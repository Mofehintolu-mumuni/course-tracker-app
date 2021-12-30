<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Factories\AchievementFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessCommentWritten
{

    private $userInstance;
    private $achievementType;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        $this->userInstance = $event->user;
        $this->achievementType = $event->achievementType;

        //use factory to check if an achievement was unlocked
        AchievementFactory::build($this->achievementType, $this->userInstance)->processAchievement();
    }
}
