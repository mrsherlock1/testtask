<?php

namespace Tests\Feature;

use App\Models\Reward;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudRewardTest extends TestCase
{

    use RefreshDatabase;

    public function test_if_user_can_get_award_list()
    {
        $create = Reward::factory()->createMany(10);
        $response = $this->get('/api/rewards');
        $response
            ->assertStatus(200)
            ->assertJsonFragment(
                ['desc' => $create->first()->reward_description]
            );
    }

    public function test_if_user_can_create_reward()
    {
        $this->assertDatabaseCount('rewards', 0);
        $request = $this->postJson('/api/rewards', [
            'reward_description' => 'Test',
            'reward_amount' => 10
        ]);
        $this->assertDatabaseHas('rewards', [
            'reward_description' => 'Test',
            'reward_amount' => 10
        ]);
    }

    public function test_if_user_can_update_reward()
    {
        $create = Reward::factory()->create();
        $this->assertDatabaseCount('rewards', 1);
        $request = $this->putJson('/api/rewards/' . $create->id . '/update', [
            'reward_description' => 'Test',
            'reward_amount' => 10
        ])->assertStatus(200);
        $this->assertDatabaseHas('rewards', [
            'reward_description' => 'Test',
            'reward_amount' => 10
        ]);
    }

    public function test_if_user_can_delete_reward()
    {
        $create = Reward::factory()->create();
        $this->assertDatabaseCount('rewards', 1);
        $request = $this->deleteJson('/api/rewards/' . $create->id . '/delete');
        $this->assertDatabaseCount('rewards', 0);
    }
}
