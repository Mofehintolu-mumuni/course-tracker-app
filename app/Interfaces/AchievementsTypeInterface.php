<?php

namespace App\Interfaces;

interface AchievementsTypeInterface
{
    const LESSON_WATCHED = "lesson_watched";
    const COMMENT_WRITTEN = "comment_written";

    const ACHIEVEMENT_TYPES_ARRAY = [
        AchievementsTypeInterface::COMMENT_WRITTEN,
        AchievementsTypeInterface::LESSON_WATCHED,
    ];
}
