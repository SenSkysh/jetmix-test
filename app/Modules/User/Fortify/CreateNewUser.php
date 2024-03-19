<?php

namespace App\Modules\User\Fortify;

use App\Modules\User\Models\User;
use App\Modules\User\DTO\UserRegisterDTO;
use App\Modules\User\Services\UserService;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    function __construct(
        private UserService $userService
    ) {
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $dto = UserRegisterDTO::validateAndCreate($input);
        $user = $this->userService->registerUser($dto);
        return $user;
    }
}
