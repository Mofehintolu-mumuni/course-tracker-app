<?php

namespace App\Services;

class AchievementAndBadgeProcessingService
{

    /**
     * Process user achivement history
     * 
     * @param object $userInstance
     * 
     * @return array
     */
    public function processUserAchievementHistory(object $userInstance): array
    {

        $currentBadgeData = $userInstance->badges()->first();

        $currentBadge = !is_null($currentBadgeData) ? $currentBadge = $currentBadgeData->badge : $currentBadge = array_keys(getBadgesConfig())[0];

        $nextBadge = getNextBadge(getBadgesConfig(), $currentBadge);

        $unlockedAchievements = $userInstance->achievements()->pluck('achievement')->toArray();

        $remainingToUnlockNextBadge = (!is_null($nextBadge)) ? getRemainingAchievementToUnlockNextBadge($nextBadge, $userInstance) : 0;

        $nextAvailableAchievement = getNextAvailableAchievement($userInstance);

        return [
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $nextAvailableAchievement,
            'current_badge' => $currentBadge,
            'next_badge' => $nextBadge,
            'remaining_to_unlock_next_badge' => $remainingToUnlockNextBadge
        ];
    }
}
