<?php

namespace App\Modules\User\Fortify;

use Illuminate\Foundation\Auth\User;
use App\Modules\User\DTO\UserPasswordResetDTO;
use App\Modules\User\Services\UserService;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    function __construct(
        private UserService $userService
    ) {
    }

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input)
    {
        $dto = UserPasswordResetDTO::validateAndCreate([
            'userId' => $user->id,
            'password' => $input['password']
        ]);
        $this->userService->resetPassword($dto);
    }
}
