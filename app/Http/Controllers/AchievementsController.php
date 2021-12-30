<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AchievementAndBadgeProcessingService;

class AchievementsController extends Controller
{

    private $achievementAndBadgeProcessingService;

    /**
     * Assign data to variables on class intantiation
     * @param  AchievementAndBadgeProcessingService  $achievementAndBadgeProcessingService
     * 
     * @return void
     */
    public function __construct(AchievementAndBadgeProcessingService $achievementAndBadgeProcessingService)
    {
        $this->achievementAndBadgeProcessingService = $achievementAndBadgeProcessingService;
    }


    /**
     * Process user achievement history
     * @param  User $user
     * 
     * @return json
     */
    public function index(User $user)
    {
        return response()->json($this->achievementAndBadgeProcessingService->processUserAchievementHistory($user));
    }
}
