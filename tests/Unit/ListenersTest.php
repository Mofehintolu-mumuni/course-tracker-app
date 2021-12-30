<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Events\BadgeUnlocked;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use Illuminate\Support\Facades\Event;
use App\Listeners\ProcessBadgeUnlocked;
use App\Listeners\ProcessLessonWatched;
use App\Listeners\ProcessCommentWritten;
use Illuminate\Foundation\Testing\WithFaker;
use App\Listeners\ProcessAchievementUnlocked;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ListenersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test process unlocked achievement listener is attached to correct event.
     *
     * @return void
     */
    public function test_process_unlocked_achievement_listener_is_attached_to_correct_event()
    {
        Event::fake();
        Event::assertListening(
            AchievementUnlocked::class,
            ProcessAchievementUnlocked::class
        );
    }


    /**
     * Test process badge unlocked listener is attached to correct event.
     *
     * @return void
     */
    public function test_process_badge_unlocked_listener_is_attached_to_correct_event()
    {
        Event::fake();
        Event::assertListening(
            BadgeUnlocked::class,
            ProcessBadgeUnlocked::class
        );
    }


    /**
     * Test process lesson watched listener is attached to correct event.
     *
     * @return void
     */
    public function test_process_lesson_watched_listener_is_attached_to_correct_event()
    {
        Event::fake();
        Event::assertListening(
            LessonWatched::class,
            ProcessLessonWatched::class
        );
    }


    /**
     * Test process comment written listener is attached to correct event.
     *
     * @return void
     */
    public function test_process_comment_written_listener_is_attached_to_correct_event()
    {
        Event::fake();
        Event::assertListening(
            CommentWritten::class,
            ProcessCommentWritten::class
        );
    }
}
