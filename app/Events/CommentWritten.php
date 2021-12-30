<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use App\Interfaces\AchievementsTypeInterface;
use Illuminate\Foundation\Events\Dispatchable;

class CommentWritten
{
    use Dispatchable, SerializesModels;

    public $user;
    public $comment;
    public $achievementType = AchievementsTypeInterface::COMMENT_WRITTEN;

    /**
     * Create a new event instance.
     * @param  Comment  $comment
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->user = Auth::user();
    }
}
