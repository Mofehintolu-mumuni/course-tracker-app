<?php

namespace App\Factories\Classes;

use App\Events\BadgeUnlocked;
use App\Events\AchievementUnlocked;
use Illuminate\Support\Facades\Log;
use App\Repositories\UnlockedBadgeRepository;
use App\Interfaces\AchievementProcessorInterface;
use App\Repositories\UnlockedAchievementRepository;

class LessonAchievementProcessor implements AchievementProcessorInterface
{

    private $userInstance;
    private $userAchievements;
    private $achievementType;
    private $achievementsConfig;

    /**
     * Assign data to variables on class intantiation
     * @param  object  $userInstance
     * @param  string  $achievementType
     * @return void
     */
    public function __construct(object $userInstance, string $achievementType)
    {
        $this->userInstance =  $userInstance;
        $this->achievementType = $achievementType;
        $this->achievementsConfig = getAchievementsConfig();
        $this->userAchievements = $this->userInstance->achievements()->get();
    }

    /**
     * This function processes lesson achieved event
     * 
     * @return void 
     */
    public function processAchievement(): void
    {
        //get all achievements for type from db and store
        $lastLessonAchievement = ($this->userAchievements->where('achievement_type', $this->achievementType)->first())->achievement ?? null;

        $lessonAchievementCount = $this->userInstance->watched()->count();

        $lessonAchievementConfigData = $this->achievementsConfig[$this->achievementType];

        $nextAchievement = getNextAchievement($lessonAchievementConfigData, $lastLessonAchievement);

        if (($lessonAchievementCount >= $lessonAchievementConfigData[$nextAchievement]) && !is_null($nextAchievement)) {
            //Save achievement
            try {
                $achievementUnlockedRepository = resolve(UnlockedAchievementRepository::class);

                $achievementUnlockedRepository->save([
                    "achievement" => $nextAchievement,
                    "achievement_type" => $this->achievementType,
                    "user_id" => $this->userInstance->id
                ]);
            } catch (\Exception $e) {

                Log::error("Error saving new unlocked achievement : {$nextAchievement} with error message {$e->getMessage()} on line {$e->getLine()} in file {$e->getFile()}");
            }

            //fire achievement unlocked event
            AchievementUnlocked::dispatch($nextAchievement, $this->userInstance);

            //check all achievements for new badges and fire badge unlocked event if applicable
            $newBadgeCheckStatus = checkForNewBadges($this->userInstance);

            if ($newBadgeCheckStatus['badge_unlocked']) {

                try {
                    $badgeUnlockedRepository = resolve(UnlockedBadgeRepository::class);

                    $badgeUnlockedRepository->save([
                        "badge" => $newBadgeCheckStatus['next_badge'],
                        "user_id" => $this->userInstance->id
                    ]);
                } catch (\Exception $e) {

                    Log::error("Error saving new unlocked badge : {$newBadgeCheckStatus['badge_unlocked']} with error message {$e->getMessage()} on line {$e->getLine()} in file {$e->getFile()}");
                }

                //fire badge unlocked event
                BadgeUnlocked::dispatch($newBadgeCheckStatus['next_badge'], $this->userInstance);
            }
        }
    }
}
