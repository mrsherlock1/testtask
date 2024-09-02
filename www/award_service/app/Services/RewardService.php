<?php

namespace App\Services;

use App\Models\Reward;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RewardService
{
    public function getList()
    {
        return Reward::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByUserId(int $userId)
    {
        return Reward::query()
            ->leftJoin('reward_user', 'rewards.id', '=', 'reward_user.reward_id')
            ->where('reward_user.user_id', $userId)
            ->get();

    }

    public function delete(Reward $reward)
    {
        $reward->delete();
        Cache::clear();
    }

    public function create(array $data): Model
    {
        $reward = Reward::query()
            ->create($data);

        Cache::clear();

        return $reward;

    }

    public function update(Reward $reward, array $data): void
    {
        $reward->update($data);

        Cache::clear();
    }

    public function attachRewardToUser(Reward $reward, int $userId)
    {
        DB::table('reward_user')
            ->insert([
                'user_id' => $userId,
                'reward_id' => $reward->id
            ]);
    }
}
