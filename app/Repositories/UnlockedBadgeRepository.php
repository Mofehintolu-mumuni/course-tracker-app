<?php

namespace App\Repositories;

use App\Models\UnlockedBadge;
use illuminate\Support\Collection;


class UnlockedBadgeRepository
{

    public $modelInstance;

    /**
     * Assign data to variables on class intantiation
     * 
     * @param UnlockedBadge $unlockedBadge
     * 
     * @return void
     */
    public function __construct(UnlockedBadge $unlockedBadge)
    {
        $this->modelInstance = $unlockedBadge;
    }


    /**
     * Save unlocked badges
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
     * List unlocked badge
     * 
     * @param int $userId
     * 
     * @return Collection
     */
    public function list(int $userId): Collection
    {
        return $this->modelInstance->where('user_id', $userId)
            ->get();
    }
}
