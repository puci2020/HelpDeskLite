<?php

namespace App\Services\Auth\Interfaces;

interface UserApiServiceInterface
{
    public function getUserData(int $id): array;
}
