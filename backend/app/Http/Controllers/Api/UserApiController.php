<?php

namespace App\Http\Controllers\Api;

use App\Services\Auth\Interfaces\UserApiServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserApiController
{
    public function __construct(private UserApiServiceInterface $userApiService){}

    public function externalUserData(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        try {
            $userData = $this->userApiService->getUserData($userId);
            return response()->json($userData);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch external user data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
