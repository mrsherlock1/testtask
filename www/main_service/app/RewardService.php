<?php

namespace App;

use Illuminate\Support\Facades\Http;

class RewardService
{
    public string $url;
    public string $token;

    public function __construct()
    {
        $this->url = config('services.reward_service.url');
        $this->token = config('services.reward_service.token');
    }

    private function performRequest(string $method, string $url, array $data = [])
    {
        $response = Http::send(
            $method, $this->url . '/api' . $url, $data
        );

        if ($response->failed()) {
            throw new \Exception('External Request failed');
        }

        return $response->json('data');
    }

    public function getUserRewards(int $userId)
    {
        return $this->performRequest('GET', '/rewards/user/' . $userId);
    }
}
