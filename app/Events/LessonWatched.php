<?php

namespace App\Events;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Queue\SerializesModels;
use App\Interfaces\AchievementsTypeInterface;
use Illuminate\Foundation\Events\Dispatchable;

class LessonWatched
{
    use Dispatchable, SerializesModels;

    public $user;
    public $lesson;
    public $achievementType = AchievementsTypeInterface::LESSON_WATCHED;

    /**
     * Create a new event instance.
     * @param  Lesson  $lesson
     * @param  User  $user
     * @return void
     */
    public function __construct(Lesson $lesson, User $user)
    {
        $this->lesson = $lesson;
        $this->user = $user;
    }
}
