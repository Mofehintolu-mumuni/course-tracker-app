<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test get achievements config.
     *
     * @return void
     */
    public function test_get_achievements_config()
    {
        $achievementConfig = getAchievementsConfig();

        $this->assertIsArray($achievementConfig);
    }


    /**
     * Test get badges config.
     *
     * @return void
     */
    public function test_get_badges_config()
    {
        $achievementConfig = getBadgesConfig();

        $this->assertIsArray($achievementConfig);
    }


    /**
     * Test get badges config.
     *
     * @return void
     */
    public function test_get_next_achievement()
    {
        $achievementConfig = getAchievementsConfig();

        $lastAchievement = null;

        $nextAchievement = getNextAchievement($achievementConfig, $lastAchievement);

        $this->assertIsString($nextAchievement);
    }


    /**
     * Test get next badge.
     *
     * @return void
     */
    public function test_get_next_badge()
    {
        $badgeConfigData = getBadgesConfig();

        $lastBadge = null;

        $nextBadge = getNextBadge($badgeConfigData, $lastBadge);

        $this->assertIsString($nextBadge);
    }


    /**
     * Test check for new badges.
     *
     * @return void
     */
    public function test_check_for_new_badges()
    {
        $userInstance = User::factory()->create();

        $newBadgeData = checkForNewBadges($userInstance);

        $this->assertIsArray($newBadgeData);

        $this->assertArrayHasKey('badge_unlocked', $newBadgeData);
        $this->assertArrayHasKey('next_badge', $newBadgeData);
    }


    /**
     * Test get remaining achievement to unlock next badge.
     *
     * @return void
     */
    public function test_get_remaining_achievement_to_unlock_next_badge()
    {
        $userInstance = User::factory()->create();

        $nextBadge = null;

        $remainingAchievement = getRemainingAchievementToUnlockNextBadge($nextBadge, $userInstance);

        $this->assertIsInt($remainingAchievement);
    }


    /**
     * Test get next available achievement.
     *
     * @return void
     */
    public function test_get_next_available_achievement()
    {
        $userInstance = User::factory()->create();

        $nextBadge = null;

        $remainingAchievement = getNextAvailableAchievement($userInstance);

        $this->assertIsArray($remainingAchievement);
    }
}
