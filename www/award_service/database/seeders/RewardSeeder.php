<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = Reward::factory()->createMany(10);

        // Pivot table fill
        foreach ($rewards as $reward) {
            DB::table('reward_user')
                ->insert([
                    'user_id' => 1,
                    'reward_id' => $reward->id
                ]);
        }
    }
}
