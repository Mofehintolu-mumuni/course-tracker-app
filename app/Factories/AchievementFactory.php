<?php

namespace App\Factories;

use App\Interfaces\AchievementsTypeInterface;
use App\Factories\Classes\LessonAchievementProcessor;
use App\Factories\Classes\CommentAchievementProcessor;

class AchievementFactory
{

    private $userInstance;
    private $achievementType;

    /**
     * Assign data to variables on class intantiation
     * @param  string  $achievementType
     * @param  object  $userInstance
     * @return void
     */
    protected function __construct(string $achievementType, object $userInstance)
    {
        $this->achievementType = $achievementType;
        $this->userInstance = $userInstance;
    }


    /**
     * Create correct class instance for factory using type of achievement
     * @param  string  $achievementType
     * @param  object  $userInstance
     * @return object
     */
    public static function build(string $achievementType, object $userInstance): object
    {
        return (new self($achievementType, $userInstance))->generateClassInstance();
    }


    /**
     * Obtain correct class instance using type of achievement
     * 
     * @return object
     */
    private function generateClassInstance(): object
    {
        switch ($this->achievementType) {
            case AchievementsTypeInterface::COMMENT_WRITTEN:
                return (new CommentAchievementProcessor($this->userInstance, $this->achievementType));
                break;
            case AchievementsTypeInterface::LESSON_WATCHED:
                return (new LessonAchievementProcessor($this->userInstance, $this->achievementType));
                break;
        }
    }
}
