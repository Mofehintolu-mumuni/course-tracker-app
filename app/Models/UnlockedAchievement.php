<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnlockedAchievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'achievement',
        'achievement_type',
        'user_id'
    ];

    /**
     * Get the user that owns the achievement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
