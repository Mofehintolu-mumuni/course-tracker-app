<?php

namespace App\Providers;

use App\Events\BadgeUnlocked;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use Illuminate\Support\Facades\Event;
use App\Listeners\ProcessBadgeUnlocked;
use App\Listeners\ProcessLessonWatched;
use App\Listeners\ProcessCommentWritten;
use App\Listeners\ProcessAchievementUnlocked;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            ProcessCommentWritten::class
        ],
        LessonWatched::class => [
            ProcessLessonWatched::class
        ],
        BadgeUnlocked::class => [
            ProcessBadgeUnlocked::class
        ],
        AchievementUnlocked::class => [
            ProcessAchievementUnlocked::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
