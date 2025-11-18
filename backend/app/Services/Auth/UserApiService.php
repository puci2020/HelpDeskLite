<?php

namespace App\Services\Auth;

use App\Services\Auth\Interfaces\UserApiServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class UserApiService implements UserApiServiceInterface
{
    public function getUserData(int $id): array
    {
        $cacheKey = "external_user_{$id}";

        return Cache::remember($cacheKey, 600, function () use ($id) {
            $response = Http::get('http://jsonplaceholder.typicode.com/users');
            if ($response->failed()) {
                throw new \Exception('External API request failed');
            }

            $users = $response->json();

            return $users[($id - 1) % count($users)];
        });
    }
}
