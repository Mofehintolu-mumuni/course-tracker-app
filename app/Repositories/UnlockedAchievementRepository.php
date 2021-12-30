<?php

namespace App\Repositories;

use illuminate\Support\Collection;
use App\Models\UnlockedAchievement;


class UnlockedAchievementRepository
{

    public $modelInstance;

    /**
     *  Assign data to variables on class intantiation
     * 
     * @param UnlockedAchievement $unlockedAchievement
     * 
     * @return void
     */
    public function __construct(UnlockedAchievement $unlockedAchievement)
    {
        $this->modelInstance = $unlockedAchievement;
    }


    /**
     * Save unlocked achievement
     * 
     * @param array $data
     * 
     * @return object|null
     */
    public function save(array $data): ?Object
    {
        return $this->modelInstance->firstOrCreate($data);
    }


    /**
     * List unlocked achievement
     * 
     * @param string $achievementType
     * @param int $userId
     * 
     * @return Collection
     */
    public function list(string $achievementType, int $userId): Collection
    {
        return $this->modelInstance->where('achievement_type', $achievementType)
            ->where('user_id', $userId)
            ->get();
    }
}
