<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Factories\AchievementFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessLessonWatched
{
    private $userInstance;

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
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        $this->userInstance = $event->user;
        $this->achievementType = $event->achievementType;

        //use factory to check if an achievement was unlocked
        AchievementFactory::build($this->achievementType, $this->userInstance)->processAchievement();
    }
}
