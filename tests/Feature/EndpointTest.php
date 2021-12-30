<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class EndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user achievement.
     *
     * @return void
     */
    public function test_view_user_achievements()
    {
        $userId = User::factory()->create()->id;

        $response = $this->get("/users/{$userId}/achievements");

        $response->assertStatus(200);
    }


    /**
     * Test user achievement response structure.
     *
     * @return void
     */
    public function test_view_user_achievements_response_structure()
    {
        $userId = User::factory()->create()->id;

        $response = $this->get("/users/{$userId}/achievements")->assertJsonStructure([
            'unlocked_achievements',
            'next_available_achievements',
            'current_badge',
            'next_badge',
            'remaining_to_unlock_next_badge'
        ]);

        $response->assertStatus(200);
    }


    /**
     * Test user achievement with invalid user.
     *
     * @return void
     */
    public function test_view_user_achievements_with_invalid_user()
    {
        $userId = 'xyz';

        $response = $this->get("/users/{$userId}/achievements");

        $response->assertStatus(404);
    }
}
