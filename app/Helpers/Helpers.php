<?php

use App\Interfaces\BadgeTypeInterface;

if (!function_exists('getAchievementsConfig')) {

    /**
     * Retrieve achievement config data
     * 
     * @return array
     */
    function getAchievementsConfig(): array
    {
        return config("achievements");
    }
}

if (!function_exists('getBadgesConfig')) {

    /**
     * Retrieve badges config data
     * 
     * @return array
     */
    function getBadgesConfig(): array
    {
        return config("badges");
    }
}

if (!function_exists('getNextAchievement')) {

    /**
     * Get next user achievement  data
     * 
     * @param array $achievementConfigData
     * @param null|string $lastAchievement
     * 
     * @return string|null
     */
    function getNextAchievement(array $achievementConfigData, ?string $lastAchievement): ?string
    {
        $nextAchievement = null;

        $achievementTypes = array_keys($achievementConfigData);

        $achievementTypesCount = sizeof($achievementTypes);

        if (!is_null($lastAchievement)) {

            $nextAcheivementKey = array_search($lastAchievement, $achievementTypes) + 1;

            ($nextAcheivementKey < $achievementTypesCount) ?  $nextAchievement = $achievementTypes[$nextAcheivementKey] : null;
        } else {
            $nextAchievement = $achievementTypes[0];
        }

        return $nextAchievement;
    }
}


if (!function_exists('getNextBadge')) {

    /**
     * Get next user badge data
     * 
     * @param array $badgeConfigData
     * @param null|string $lastBadge
     * 
     * @return string|null
     */
    function getNextBadge(array $badgeConfigData, ?string $lastBadge): ?string
    {

        $nextBadge = null;

        $badgeTypes = array_keys($badgeConfigData);

        $badgeTypesCount = sizeof($badgeTypes);

        if (!is_null($lastBadge)) {

            $nextBadgeKey = array_search($lastBadge, $badgeTypes) + 1;

            ($nextBadgeKey < $badgeTypesCount) ?  $nextBadge = $badgeTypes[$nextBadgeKey] : null;
        } else {
            $nextBadge = $badgeTypes[1];
        }

        return $nextBadge;
    }
}


if (!function_exists('checkForNewBadges')) {

    /**
     * Check for new badges
     * 
     * @param object $userInstance
     * 
     * @return array
     */
    function checkForNewBadges(object $userInstance): array
    {

        $badgeConfigData = getBadgesConfig();

        $achievementsConfigData = getAchievementsConfig();

        $currentBadge = $userInstance->badges()->first();

        $nextBadge = getNextBadge($badgeConfigData, $currentBadge);

        $numberOfAchievementsToUnlockNextBadge = $badgeConfigData[$nextBadge]['achievement_count'];

        $achievementsTypes = array_keys($achievementsConfigData);

        $achievementCount = 0;

        $userAchievements = $userInstance->achievements()->get();

        $badgeCheckData = [
            'badge_unlocked' => false,
            'next_badge' => $nextBadge
        ];

        collect($achievementsTypes)->map(function ($achievement, $key) use ($userInstance, &$achievementCount, $userAchievements) {

            $achievementCount += $userAchievements->where('achievement_type', $achievement)->count();
        });

        if ($achievementCount == $numberOfAchievementsToUnlockNextBadge) {
            //new badge Unlocked
            $badgeCheckData['badge_unlocked'] = true;
        }

        return $badgeCheckData;
    }
}


if (!function_exists('getRemainingAchievementToUnlockNextBadge')) {

    /**
     * Get remaining achievement to unlock next badge
     * 
     * @param null|string $nextBadge
     * @param object $userInstance
     * 
     * @return int
     */
    function getRemainingAchievementToUnlockNextBadge(?string $nextBadge, object $userInstance): int
    {
        $remainingAchievement = 0;

        if (!is_null($nextBadge)) {
            $badgeConfigData = getBadgesConfig();

            $userAchievements = $userInstance->achievements()->count();

            $remainingAchievement = $badgeConfigData[$nextBadge]['achievement_count'] - $userAchievements;
        }

        return $remainingAchievement;
    }
}


if (!function_exists('getNextAvailableAchievement')) {

    /**
     * Get next available achievement
     * 
     * @param object $userInstance
     * 
     * @return array
     */
    function getNextAvailableAchievement(object $userInstance): array
    {
        $achievementsConfigData = getAchievementsConfig();

        $achievementsTypes = array_keys($achievementsConfigData);

        $achievementArray = [];

        $userAchievements = $userInstance->achievements()->get();

        collect($achievementsTypes)->map(function ($achievement, $key) use (&$achievementArray, $userAchievements, $achievementsConfigData) {

            $achievementData = $userAchievements->where('achievement_type', $achievement)->first();

            $lastAchievement = !is_null($achievementData) ? $achievementData->achievement : null;

            $nextAcheivement = getNextAchievement($achievementsConfigData[$achievement], $lastAchievement);

            (!is_null($nextAcheivement)) ? $achievementArray[] = $nextAcheivement : null;
        });

        return $achievementArray;
    }
}
