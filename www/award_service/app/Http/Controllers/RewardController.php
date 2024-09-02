<?php

namespace App\Http\Controllers;


use App\Http\Requests\RewardRequest;
use App\Http\Resources\RewardResource;
use App\Models\Reward;
use App\Services\RewardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    public function __construct(public RewardService $rewardService)
    {
    }

    public function index(Request $request)
    {
        $rewards = Cache::remember('rewards_list', 10800, function () {
            return $this->rewardService->getList();
        });
        return RewardResource::collection($rewards);
    }

    public function attachToUser(Reward $reward, int $userId)
    {
        try {
            $this->rewardService->attachRewardToUser(
                $reward, $userId
            );
            return response()->json([
                'message' => 'Attached'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function delete(Reward $reward)
    {
        try {
            $this->rewardService->delete($reward);
            return response()->json([
                'message' => 'Reward Deleted'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }

    public function create(RewardRequest $request)
    {
        try {
            $reward = $this->rewardService->create($request->validated());
            return new RewardResource($reward);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function update(Reward $reward, RewardRequest $request)
    {
        try {
            $this->rewardService->update($reward, $request->validated());
            return new RewardResource($reward->fresh());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function getByUserId(int $userId)
    {
        $rewards = $this->rewardService->getByUserId($userId);
        return RewardResource::collection($rewards);
    }

}
